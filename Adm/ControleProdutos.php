<?php

session_start();

require_once 'dompdf/autoload.inc.php';

include_once "clsProdutos.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$Cad = new clsCadastro();

$CodProduto         = filter_input(INPUT_POST, "CodProduto", FILTER_VALIDATE_INT);
$DescProduto        = filter_input(INPUT_POST, "DescProduto", FILTER_SANITIZE_SPECIAL_CHARS);
$ValProduto         = filter_input(INPUT_POST, "ValProduto");
$VenctoProduto      = filter_input(INPUT_POST, "VenctoProduto");
$FormListagem       = filter_input(INPUT_POST, "FormListagem");
$DtInicio           = filter_input(INPUT_POST, "DtInicio");
$DtFim              = filter_input(INPUT_POST, "DtFim");

$DtInicio = date('Y-m-d', strtotime(str_replace('/', '-', $DtInicio)));
$DtFim = date('Y-m-d', strtotime(str_replace('/', '-', $DtFim)));

$Arquivo = "";
$ArquivoTmp = "";
$Destino = "";

if (isset($_FILES["Arquivo"]) && $_FILES["Arquivo"]["error"] === UPLOAD_ERR_OK) {
    $Arquivo = $_FILES["Arquivo"]["name"];
    $ArquivoTmp = $_FILES["Arquivo"]["tmp_name"];
    $Destino = 'assets/imagesprod/' . $Arquivo;
}

$Cad->setCodProduto($CodProduto);
$Cad->setDescProduto($DescProduto);
$Cad->setValProduto($ValProduto);
$Cad->setVenctoProduto($VenctoProduto);
$Cad->setFormListagem($FormListagem);
$Cad->setDtInicio($DtInicio);
$Cad->setDtFim($DtFim);
$Cad->setArquivo($Arquivo);
$Cad->setArquivoTmp($ArquivoTmp);
$Cad->setDestino($Destino);

if (!isset($_SESSION['Itens'])) {
    $_SESSION['Itens'] = array();
} elseif (isset($_POST["Incluir"])) {

    echo $Cad->Incluir();
} elseif (isset($_POST["Excluir"])) {

    echo $Cad->Excluir();
} elseif (isset($_POST["Pesquisar"])) {

    echo $Cad->Pesquisar();
} elseif (isset($_POST["Carrossel"])) {

    echo $Cad->Carrossel();
} elseif (isset($_POST["Card"])) {

    echo $Cad->Card();
} elseif (isset($_POST["Alterar"])) {

    echo $Cad->Alterar();
} elseif (isset($_POST["ListaOrdem"])) {

    include_once "assets/Conexao.php";

    try {

        if ($FormListagem == 'C') {

            $Matriz = $conexao->prepare("select * from PRODUTOS order by CodProduto");
        } elseif ($FormListagem == 'D') {

            $Matriz = $conexao->prepare("select * from PRODUTOS order by DescProduto");
        }

        $Matriz->execute();

        $Relat = '<h1 style="text-align: center;">Dados Produtos (Vencimento) (Prazo/Vista)</h1>';
        $Relat .= '<table style="width: 100%; border-collapse: collapse;">';
        $Relat .= '<tr>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Código</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Descrição</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Valor</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Vencimento</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Imagem</th>';
        $Relat .= '</tr>';

        while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) {
            $Relat .= '<tr>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CodProduto . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->DescProduto . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->ValProduto . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->VenctoProduto . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;"><img src="data:image/jpeg;base64,' . base64_encode($Linha->Images) . '" alt="Imagem do Produto" width="60" height="60"></td>';
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
} elseif (isset($_POST["ListaVencto"])) {

    include_once "assets/Conexao.php";

    try {
        $Matriz = $conexao->prepare("select * from PRODUTOS where VenctoProduto between ? AND ?");
        $Matriz->bindParam(1, $DtInicio);
        $Matriz->bindParam(2, $DtFim);
        $Matriz->execute();

        $Relat = '<h1 style="text-align: center;">Dados Produtos (Vencimento) (Prazo/Vista)</h1>';
        $Relat .= '<table style="width: 100%; border-collapse: collapse;">';
        $Relat .= '<tr>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Código</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Descrição</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Valor</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Vencimento</th>';
        $Relat .= '<th style="padding: 8px; text-align: center;">Imagem</th>';
        $Relat .= '</tr>';

        while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) {
            $Relat .= '<tr>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CodProduto . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->DescProduto . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->ValProduto . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->VenctoProduto . '</td>';
            $Relat .= '<td style="padding: 8px; text-align: center;"><img src="data:image/jpeg;base64,' . base64_encode($Linha->Images) . '" alt="Imagem do Produto" width="60" height="60"></td>';
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


// ============================== C A R R I N H O  ==============================

elseif ($_GET['Acao'] == 'carrinho') {
    $CodProduto = $_GET['CodProduto'];

    if (!isset($_SESSION['Itens'][$CodProduto])) {
        $_SESSION['Itens'][$CodProduto] = 1;
        header("location: ../Site/index.php");
    } else {
        $_SESSION['Itens'][$CodProduto] += 1;
        header("location: ../Site/index.php");
    }
} elseif (count($_SESSION['Itens']) == 0) {
    echo 'Carrinho Vazio <br>';
    echo '<a href="../Site/index.php"> Produto nao adicionado</a>';
}


// ============================== C O M P R A ==============================

elseif ($_GET['Acao'] == 'compra') {

    $Cad->Comprar();
}
