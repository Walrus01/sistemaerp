<?php

session_start();

require_once 'dompdf/autoload.inc.php';

include_once "clsClientes.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$Cli = new clsClientes();

$CodCliente     = filter_input(INPUT_POST, "CodCliente", FILTER_VALIDATE_INT);
$NomeCliente    = filter_input(INPUT_POST, "NomeCliente", FILTER_SANITIZE_SPECIAL_CHARS);
$CelCliente     = filter_input(INPUT_POST, "CelCliente");
$CPFCliente     = filter_input(INPUT_POST, "CPFCliente");
$CEPCliente     = filter_input(INPUT_POST, "CEPCliente");
$EmailCliente     = filter_input(INPUT_POST, "EmailCliente");
$SenhaCliente     = filter_input(INPUT_POST, "SenhaCliente");

$Cli->setCodCliente($CodCliente);
$Cli->setNomeCliente($NomeCliente);
$Cli->setCelCliente($CelCliente);
$Cli->setCPFCliente($CPFCliente);
$Cli->setCEPCliente($CEPCliente);
$Cli->setEmailCliente($EmailCliente);
$Cli->setSenhaCliente($SenhaCliente);

if (isset($_POST["Incluir"])) {

    echo $Cli->Incluir();
} elseif (isset($_POST["Excluir"])) {

    echo $Cli->Excluir();
} elseif (isset($_POST["Pesquisar"])) {

    echo $Cli->Pesquisar();
} elseif (isset($_POST["Alterar"])) {

    echo $Cli->Alterar();
} elseif (isset($_POST["Login"])) {

    echo $Cli->Login();
} elseif (isset($_GET["Logout"])) {

    echo $Cli->Logout();
} else {

    include_once "assets/Conexao.php";

    try {
        $Matriz = $conexao->prepare("select * from CLIENTES INNER JOIN LOGIN on CLIENTES.CodCliente = LOGIN.CodCliente order by CLIENTES.CodCliente");
        $Matriz->execute();

        $Relat = '<h1 style="text-align: center;">Dados Clientes</h1>';
        $Relat .= '<table style="width: 100%; border-collapse: collapse;">';
        $Relat .= '<tr>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Código</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Nome</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Celular</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">CPF</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">CEP</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Email</th>';
        $Relat .= '</tr>';

        while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) {
            $Relat .= '<tr>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CodCliente . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->NomeCliente . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CelCliente . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CPFCliente . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CEPCliente . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->EmailCliente . '</td>';
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
