<?php

session_start();

require_once 'dompdf/autoload.inc.php';

include_once "clsFaleConosco.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$FC = new clsFaleConosco();

$NomeCliente        = filter_input(INPUT_POST, "NomeCliente", FILTER_SANITIZE_SPECIAL_CHARS);
$EmailCliente       = filter_input(INPUT_POST, "EmailCliente");
$AssuntoFC          = filter_input(INPUT_POST, "AssuntoFC");
$DescFC             = filter_input(INPUT_POST, "DescFC");
$DtAtual            = date('Y-m-d H:i:s');

$FC->setNomeCliente($NomeCliente);
$FC->setEmailCliente($EmailCliente);
$FC->setAssuntoFC($AssuntoFC);
$FC->setDescFC($DescFC);
$FC->setDtAtual($DtAtual);

if (isset($_POST["Enviar"])) {

    echo $FC->Incluir();
} else {

    include_once "assets/Conexao.php";

    try {
        $Matriz = $conexao->prepare("select * from FC");
        $Matriz->execute();

        $Relat = '<h1 style="text-align: center;">Dados Clientes</h1>';
        $Relat .= '<table style="width: 100%; border-collapse: collapse;">';
        $Relat .= '<tr>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Nome</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Email</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Assunto</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Descrição</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Data</th>';
        $Relat .= '</tr>';

        while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) {
            switch ($Linha->AssuntoFC) {
                case 'S':
                    $Linha->AssuntoFC = "Sugestão";
                    break;
                case 'C':
                    $Linha->AssuntoFC = "Critica";
                    break;
                case 'E':
                    $Linha->AssuntoFC = "Elogio";
                    break;
            }

            $Relat .= '<tr>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->NomeCliente . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->EmailCliente . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->AssuntoFC . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->DescFC . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->DtAtual . '</td>';
            $Relat .= '</tr>';
        }
        $Relat .= '</table>';

        $dompdf->loadHtml($Relat);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("relatorio.pdf", array("Attachment" => false));
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
