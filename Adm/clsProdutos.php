<?php

class clsCadastro
{
    private $CodProduto;

    public function setCodProduto($Cod)
    {
        $this->CodProduto = $Cod;
    }

    public function getCodProduto()
    {
        return $this->CodProduto;
    }

    /*-----------------------------------------------------------------------------*/

    private $DescProduto;

    public function setDescProduto($Desc)
    {
        $this->DescProduto = $Desc;
    }

    public function getDescProduto()
    {
        return $this->DescProduto;
    }

    /*-----------------------------------------------------------------------------*/

    private $ValProduto;

    public function setValProduto($Val)
    {
        $this->ValProduto = $Val;
    }

    public function getValProduto()
    {
        return $this->ValProduto;
    }

    /*-----------------------------------------------------------------------------*/

    private $VenctoProduto;

    public function setVenctoProduto($Vec)
    {
        $this->VenctoProduto = $Vec;
    }

    public function getVenctoProduto()
    {
        return $this->VenctoProduto;
    }

    /*-----------------------------------------------------------------------------*/

    private $FormListagem;

    public function setFormListagem($List)
    {
        $this->FormListagem = $List;
    }

    public function getFormListagem()
    {
        return $this->FormListagem;
    }

    /*-----------------------------------------------------------------------------*/

    private $DtInicio;

    public function setDtInicio($DtI)
    {
        $this->DtInicio = $DtI;
    }

    public function getDtInicio()
    {
        return $this->DtInicio;
    }

    /*-----------------------------------------------------------------------------*/

    private $DtFim;

    public function setDtFim($DtF)
    {
        $this->DtFim = $DtF;
    }

    public function getDtFim()
    {
        return $this->DtFim;
    }

    /*-----------------------------------------------------------------------------*/

    private $Arquivo;

    public function setArquivo($Ara)
    {
        $this->Arquivo = $Ara;
    }

    public function getArquivo()
    {
        return $this->Arquivo;
    }

    /*-----------------------------------------------------------------------------*/

    private $ArquivoTmp;

    public function setArquivoTmp($Art)
    {
        $this->ArquivoTmp = $Art;
    }

    public function getArquivoTmp()
    {
        return $this->ArquivoTmp;
    }

    /*-----------------------------------------------------------------------------*/

    private $Destino;

    public function setDestino($Des)
    {
        $this->Destino = $Des;
    }

    public function getDestino()
    {
        return $this->Destino;
    }

    /*-----------------------------------------------------------------------------*/

    public function Incluir()
    {

        include_once "assets/Conexao.php";

        try {
            move_uploaded_file($this->ArquivoTmp, $this->Destino);

            $Imagem = file_get_contents("http://localhost/SistemaERP/Adm/assets/imagesprod/" . $this->Arquivo);

            $Comando = $conexao->prepare("insert into PRODUTOS (CodProduto,DescProduto,ValProduto,VenctoProduto,Images_txt,Images) values (?,?,?,?,?,?)");
            $Comando->bindParam(1, $this->CodProduto);
            $Comando->bindParam(2, $this->DescProduto);
            $Comando->bindParam(3, $this->ValProduto);
            $Comando->bindParam(4, $this->VenctoProduto);
            $Comando->bindParam(5, $this->Arquivo);
            $Comando->bindParam(6, $Imagem);

            if ($Comando->execute()) {
                $Retorno = "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                            <h1>Produto cadastrado com sucesso!</h1>
                            <a href='index.php'><button>Voltar ao Menu</button></a>
                            <a href='FormProdutos.php'><button>Continuar Cadastrando</button></a>
                            </body>";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro " . $Erro->getMessage();
        }
        return $Retorno;
    }

    /*-----------------------------------------------------------------------------*/

    public function Excluir()
    {
        include_once "assets/Conexao.php";

        try {
            //unlink("assets/imagesprod/" . $Linha->Foto . "");
            $Comando = $conexao->prepare("delete from PRODUTOS where CodProduto = ?");
            $Comando->bindParam(1, $this->CodProduto);

            if ($Comando->execute()) {
                $Retorno = "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                            <h1>Produto deletado com sucesso!</h1>
                            <a href='index.php'><button>Voltar ao Menu</button></a>
                            <a href='FormProdutos.php'><button>Continuar Deletando</button></a>
                            </body>";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro " . $Erro->getMessage();
        }
        return $Retorno;
    }

    /*-----------------------------------------------------------------------------*/

    public function Pesquisar()
    {
        include_once "assets/Conexao.php";

        try {


            $Comando = $conexao->prepare("select DescProduto, ValProduto, VenctoProduto, Images_txt from PRODUTOS where CodProduto = ?");
            $Comando->bindParam(1, $this->CodProduto);

            $Comando->execute();
            $Produtos = $Comando->fetchAll();

            $RetornoJSON = json_encode($Produtos);

            echo $RetornoJSON;
        } catch (Exception $erro) {
            $RetornoJSON = "Erro: " . $erro->getMessage();
        }
    }

    /*-----------------------------------------------------------------------------*/

    public function Carrossel()
    {
        include_once "assets/Conexao.php";

        try {


            $Comando = $conexao->prepare("select CodProduto, DescProduto, Images from PRODUTOS LIMIT 2");

            $Comando->execute();
            $Carrossel = $Comando->fetchAll(PDO::FETCH_ASSOC);

            foreach ($Carrossel as &$item) {
                // Codifique a imagem BLOB como uma string Base64
                $item['Images'] = base64_encode($item['Images']);
            }

            $RetornoJSON = json_encode($Carrossel);

            echo $RetornoJSON;
        } catch (Exception $erro) {
            $RetornoJSON = "Erro: " . $erro->getMessage();
        }
    }

    /*-----------------------------------------------------------------------------*/

    public function Card()
    {
        include_once "assets/Conexao.php";

        try {


            $Comando = $conexao->prepare("select CodProduto, DescProduto, ValProduto, Images from PRODUTOS ORDER BY CodProduto DESC LIMIT 3");

            $Comando->execute();
            $Card = $Comando->fetchAll(PDO::FETCH_ASSOC);

            foreach ($Card as &$item) {
                // Codifique a imagem BLOB como uma string Base64
                $item['Images'] = base64_encode($item['Images']);
            }

            $RetornoJSON = json_encode($Card);

            echo $RetornoJSON;
        } catch (Exception $erro) {
            $RetornoJSON = "Erro: " . $erro->getMessage();
        }
    }

    /*-----------------------------------------------------------------------------*/

    public function Alterar()
    {
        include_once "assets/Conexao.php";

        try {
            move_uploaded_file($this->ArquivoTmp, $this->Destino);

            $Imagem = file_get_contents("http://localhost/SistemaERP/Adm/assets/imagesprod/" . $this->Arquivo);

            $Comando = $conexao->prepare("UPDATE PRODUTOS SET DescProduto = ?, ValProduto = ?, VenctoProduto = ?, Images_txt = ?, Images = ? WHERE CodProduto = ?");

            $Comando->bindParam(1, $this->DescProduto);
            $Comando->bindParam(2, $this->ValProduto);
            $Comando->bindParam(3, $this->VenctoProduto);
            $Comando->bindParam(4, $this->Arquivo);
            $Comando->bindParam(5, $Imagem);
            $Comando->bindParam(6, $this->CodProduto);

            if ($Comando->execute()) {
                $Retorno = "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                            <h1>Cliente atualizado com sucesso!</h1>
                            <a href='index.php'><button>Voltar ao Menu</button></a>
                            <a href='FormProdutos.php'><button>Continuar Atualizando</button></a>
                            </body>";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro " . $Erro->getMessage();
        }

        return $Retorno;
    }

    /*-----------------------------------------------------------------------------*/

    public function Comprar()
    {
        $TotalGeral = 0;
        foreach ($_SESSION['Itens'] as $CodProduto => $Quant) {
            include_once "assets/Conexao.php";
            try {
                $Comando = $conexao->prepare("SELECT DescProduto, ValProduto FROM PRODUTOS WHERE CodProduto = ?");
                $Comando->bindParam(1, $CodProduto);

                $Comando->execute();
                $Produtos = $Comando->fetchAll();
                foreach ($Produtos as $Produto) {
                    // Movido para dentro do loop
                    $DescProduto = $Produto['DescProduto'];
                    $ValProduto = str_replace(',', '.', $Produto['ValProduto']);

                    // Calculo o valor final
                    $Total = $ValProduto * $Quant;
                    $TotalGeral += $Total;

                    // Adiciona classe Bootstrap para criar um card
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Nome do Produto: ' . $DescProduto . '</h5>';
                    echo '<p class="card-text">Valor do Produto: ' . $ValProduto . '</p>';
                    echo '<p class="card-text">Quantidade do Produto: ' . $Quant . '</p>';
                    echo '<p class="card-text">Valor Total: ' . number_format($Total, 2, ",", ".") . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<br>';
                }
            } catch (Exception $erro) {
                $RetornoJSON = "Erro: " . $erro->getMessage();
                // Tratar o erro conforme necessário
            }
        }

        // Adiciona classe Bootstrap para criar um card para o total geral
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Total Geral:</h5>';
        echo '<p class="card-text">' . number_format($TotalGeral, 2, ",", ".") . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<br>';

        // Adiciona dois botões Bootstrap

        echo '<br>';
        echo 'Compra Finalizada com Sucesso!';
        echo '<br>';

        echo '<form method="post" action="">';
        echo '<button type="button" class="btn btn-primary" onclick="window.history.back();">Voltar</button>';
        echo '<button type="submit" name="FCompra" class="btn btn-secondary">Finalizar Compra</button>';
        echo '</form>';

        echo '<br>';

        // Verifica se o segundo botão foi clicado antes de apagar a sessão
        if (isset($_POST['FCompra'])) {
            //Apago a sessao
            if (isset($_SESSION['Itens'])) {
                unset($_SESSION['Itens']);
                header("location: ../Site/index.php");
            }
        }
    }


    /*-----------------------------------------------------------------------------*/
}
