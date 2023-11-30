<?php

class clsVendas
{
    private $CodVenda;

    public function setCodVenda($Ven)
    {
        $this->CodVenda = $Ven;
    }

    public function getCodVenda()
    {
        return $this->CodVenda;
    }

    /*-----------------------------------------------------------------------------*/

    private $CodCliente;

    public function setCodCliente($Cli)
    {
        $this->CodCliente = $Cli;
    }

    public function getCodCliente()
    {
        return $this->CodCliente;
    }

    /*-----------------------------------------------------------------------------*/

    private $CodProduto;

    public function setCodProduto($Pro)
    {
        $this->CodProduto = $Pro;
    }

    public function getCodProduto()
    {
        return $this->CodProduto;
    }

    /*-----------------------------------------------------------------------------*/

    private $QuantVenda;

    public function setQuantVenda($Qntd)
    {
        $this->QuantVenda = $Qntd;
    }

    public function getQuantVenda()
    {
        return $this->QuantVenda;
    }

    /*-----------------------------------------------------------------------------*/

    private $DataVenda;

    public function setDataVenda($Dt)
    {
        $this->DataVenda = $Dt;
    }

    public function getDataVenda()
    {
        return $this->DataVenda;
    }

    /*-----------------------------------------------------------------------------*/

    private $FormaPagto;

    public function setFormaPagto($Pgto)
    {
        $this->FormaPagto = $Pgto;
    }

    public function getFormaPagto()
    {
        return $this->FormaPagto;
    }

    /*-----------------------------------------------------------------------------*/

    private $FormListagemPV;

    public function setFormListagemPV($FPgto)
    {
        $this->FormListagemPV = $FPgto;
    }

    public function getFormListagemPV()
    {
        return $this->FormListagemPV;
    }

    /*-----------------------------------------------------------------------------*/

    public function Incluir()
    {

        include_once "assets/Conexao.php";

        try {
            $Comando = $conexao->prepare("insert into VENDAS (CodCliente,CodProduto,QuantVenda,DataVenda,FormaPagto) values (?,?,?,?,?)");
            $Comando->bindParam(1, $this->CodCliente);
            $Comando->bindParam(2, $this->CodProduto);
            $Comando->bindParam(3, $this->QuantVenda);
            $Comando->bindParam(4, $this->DataVenda);
            $Comando->bindParam(5, $this->FormaPagto);

            if ($Comando->execute()) {
                switch ($this->FormaPagto) {
                    case 'V':
                        $this->FormaPagto = "À Vista";
                        break;
                    case 'P':
                        $this->FormaPagto = "À Prazo";
                        break;
                }

                $Retorno =  "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                <h1>Venda cadastrada com sucesso!</h1>
                <a href='index.php'><button>Voltar ao Menu</button></a>
                <a href='FormProdutos.php'><button>Continuar Vendendo</button></a>
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
            $Comando = $conexao->prepare("delete from VENDAS where CodProduto = ? and CodCliente = ?");
            $Comando->bindParam(1, $this->CodProduto);
            $Comando->bindParam(2, $this->CodCliente);

            if ($Comando->execute()) {
                $Retorno = "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                            <h1>Venda deletada com sucesso!</h1>
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


            $Comando = $conexao->prepare("select CodCliente, CodProduto, QuantVenda, DataVenda, FormaPagto from VENDAS where CodVenda = ?");
            $Comando->bindParam(1, $this->CodVenda);

            $Comando->execute();
            $Vendas = $Comando->fetchAll();

            $RetornoJSON = json_encode($Vendas);

            echo $RetornoJSON;
        } catch (Exception $erro) {
            $RetornoJSON = "Erro: " . $erro->getMessage();
        }
    }

    /*-----------------------------------------------------------------------------*/

    public function PesquisarNome()
    {
        include_once "assets/Conexao.php";

        try {


            $Comando = $conexao->prepare("select CLIENTES.NomeCliente
            from VENDAS
            INNER JOIN CLIENTES on VENDAS.CodCliente = CLIENTES.CodCliente
            WHERE CLIENTES.CodCliente = ?;");
            $Comando->bindParam(1, $this->CodCliente);

            $Comando->execute();
            $Vendas = $Comando->fetchAll();

            $RetornoJSON = json_encode($Vendas);

            echo $RetornoJSON;
        } catch (Exception $erro) {
            $RetornoJSON = "Erro: " . $erro->getMessage();
        }
    }

    /*-----------------------------------------------------------------------------*/

    public function PesquisarDesc()
    {
        include_once "assets/Conexao.php";

        try {


            $Comando = $conexao->prepare("select PRODUTOS.DescProduto
            from VENDAS
            INNER JOIN PRODUTOS on VENDAS.CodProduto = PRODUTOS.CodProduto
            WHERE PRODUTOS.CodProduto = ?;");
            $Comando->bindParam(1, $this->CodProduto);

            $Comando->execute();
            $Vendas = $Comando->fetchAll();

            $RetornoJSON = json_encode($Vendas);

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
            $Comando = $conexao->prepare("UPDATE VENDAS SET CodCliente = ?, CodProduto = ?, QuantVenda = ?, DataVenda = ?, FormaPagto = ? WHERE CodVenda = ?");

            $Comando->bindParam(1, $this->CodCliente);
            $Comando->bindParam(2, $this->CodProduto);
            $Comando->bindParam(3, $this->QuantVenda);
            $Comando->bindParam(4, $this->DataVenda);
            $Comando->bindParam(5, $this->FormaPagto);
            $Comando->bindParam(6, $this->CodVenda);

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
}
