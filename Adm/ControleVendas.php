<?php

require_once 'dompdf/autoload.inc.php';

include_once "clsVendas.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$Venda = new clsVendas();

$CodVenda         = filter_input(INPUT_POST, "CodVenda", FILTER_VALIDATE_INT);
$CodCliente       = filter_input(INPUT_POST, "CodCliente", FILTER_VALIDATE_INT);
$CodProduto       = filter_input(INPUT_POST, "CodProduto", FILTER_VALIDATE_INT);
$QuantVenda       = filter_input(INPUT_POST, "QuantVenda", FILTER_VALIDATE_INT);
$DataVenda        = filter_input(INPUT_POST, "DataVenda");
$FormaPagto       = filter_input(INPUT_POST, "FormaPagto");
$FormListagemPV   = filter_input(INPUT_POST, "FormListagemPV");

$Venda->setCodVenda($CodVenda);
$Venda->setCodCliente($CodCliente);
$Venda->setCodProduto($CodProduto);
$Venda->setQuantVenda($QuantVenda);
$Venda->setDataVenda($DataVenda);
$Venda->setFormaPagto($FormaPagto);
$Venda->setFormListagemPV($FormListagemPV);

if (isset($_POST["Incluir"])) {

  echo $Venda->Incluir();
} elseif (isset($_POST["Excluir"])) {

  echo $Venda->Excluir();
} elseif (isset($_POST["Pesquisar"])) {

  echo $Venda->Pesquisar();
} elseif (isset($_POST["PesquisarNome"])) {

  echo $Venda->PesquisarNome();
} elseif (isset($_POST["PesquisarDesc"])) {

  echo $Venda->PesquisarDesc();
} elseif (isset($_POST["Alterar"])) {

  echo $Venda->Alterar();
} elseif (isset($_POST["ListaPV"])) {

  include_once "assets/Conexao.php";

  try {
    $Matriz = $conexao->prepare("select VENDAS.CodVenda, VENDAS.CodCliente, CLIENTES.NomeCliente, VENDAS.CodProduto, PRODUTOS.DescProduto, VENDAS.QuantVenda, VENDAS.DataVenda, VENDAS.FormaPagto
                                 from VENDAS
                                 INNER JOIN PRODUTOS on VENDAS.CodProduto = PRODUTOS.CodProduto
                                 INNER JOIN CLIENTES on VENDAS.CodCliente = CLIENTES.CodCliente
                                 WHERE FormaPagto = ?
                                 order by CodVenda;");
    $Matriz->bindParam(1, $FormListagemPV);
    $Matriz->execute();

    $Relat = '<h1 style="text-align: center;">Dados Vendas (Prazo/Vista)</h1>';
    $Relat .= '<table style="width: 100%; border-collapse: collapse;">';
    $Relat .= '<tr>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Código da Venda</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Código do Cliente</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Código do Produto</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Quantidade de Venda</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Data da Venda</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Forma de Pagamento</th>';
    $Relat .= '</tr>';

    while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) {
      $Relat .= '<tr>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CodVenda . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CodCliente . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CodProduto . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->QuantVenda . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->DataVenda . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->FormaPagto . '</td>';
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
} else {

  include_once "assets/Conexao.php";

  try {
    $Matriz = $conexao->prepare("select VENDAS.CodVenda, VENDAS.CodCliente, CLIENTES.NomeCliente, VENDAS.CodProduto, PRODUTOS.DescProduto, VENDAS.QuantVenda, VENDAS.DataVenda, VENDAS.FormaPagto
                                 from VENDAS
                                 INNER JOIN PRODUTOS on VENDAS.CodProduto = PRODUTOS.CodProduto
                                 INNER JOIN CLIENTES on VENDAS.CodCliente = CLIENTES.CodCliente
                                 order by CodVenda;");
    $Matriz->execute();

    $Relat = '<h1 style="text-align: center;">Dados Vendas</h1>';
    $Relat .= '<table style="width: 100%; border-collapse: collapse;">';
    $Relat .= '<tr>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Código da Venda</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Código do Cliente</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Código do Produto</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Quantidade de Venda</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Data da Venda</th>';
    $Relat .= '<th style="padding: 8px; text-align: center;">Forma de Pagamento</th>';
    $Relat .= '</tr>';

    while ($Linha = $Matriz->fetch(PDO::FETCH_OBJ)) {
      $Relat .= '<tr>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CodVenda . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CodCliente . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->CodProduto . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->QuantVenda . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->DataVenda . '</td>';
      $Relat .= '<td style="padding: 8px; text-align: center;">' . $Linha->FormaPagto . '</td>';
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
