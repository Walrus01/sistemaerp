<?php

class clsFaleConosco
{

    private $NomeCliente;

    public function setNomeCliente($NomeCli)
    {
        $this->NomeCliente = $NomeCli;
    }

    public function getNomeCliente()
    {
        return $this->NomeCliente;
    }

    /*-----------------------------------------------------------------------------*/

    private $EmailCliente;

    public function setEmailCliente($EmailCli)
    {
        $this->EmailCliente = $EmailCli;
    }

    public function getEmailCliente()
    {
        return $this->EmailCliente;
    }

    /*-----------------------------------------------------------------------------*/

    private $AssuntoFC;

    public function setAssuntoFC($AssFC)
    {
        $this->AssuntoFC = $AssFC;
    }

    public function getAssuntoFC()
    {
        return $this->AssuntoFC;
    }

    /*-----------------------------------------------------------------------------*/

    private $DescFC;

    public function setDescFC($DFC)
    {
        $this->DescFC = $DFC;
    }

    public function getDescFC()
    {
        return $this->DescFC;
    }

    /*-----------------------------------------------------------------------------*/

    private $DtAtual;

    public function setDtAtual($DTA)
    {
        $this->DtAtual = $DTA;
    }

    public function getDtAtual()
    {
        return $this->DtAtual;
    }

    /*-----------------------------------------------------------------------------*/

    public function Incluir()
    {

        include_once "assets/Conexao.php";

        try {

            $Comando = $conexao->prepare("insert into FC (NomeCliente,EmailCliente,AssuntoFC,DescFC,DtAtual) values (?,?,?,?,?)");
            $Comando->bindParam(1, $this->NomeCliente);
            $Comando->bindParam(2, $this->EmailCliente);
            $Comando->bindParam(3, $this->AssuntoFC);
            $Comando->bindParam(4, $this->DescFC);
            $Comando->bindParam(5, $this->DtAtual);


            if ($Comando->execute()) {
                $Retorno = "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                            <h1>Muito obrigado pelo Feedback!</h1>
                            <a href='../Site/index.php'><button>Voltar ao Menu</button></a>
                            </body>";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro " . $Erro->getMessage();
        }
        return $Retorno;
    }

    /*-----------------------------------------------------------------------------

    public function Excluir()
    {
        include_once "assets/Conexao.php";

        try {
            $Comando = $conexao->prepare("delete from CLIENTES where CodCliente = ?");
            $Comando->bindParam(1, $this->CodCliente);

            $Comando->execute();

            $Comando = $conexao->prepare("delete from LOGIN where CodCliente = ?");
            $Comando->bindParam(1, $this->CodCliente);

            if ($Comando->execute()) {
                $Retorno = "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                            <h1>Cliente deletado com sucesso!</h1>
                            <a href='index.php'><button>Voltar ao Menu</button></a>
                            <a href='FormProdutos.php'><button>Continuar Deletando</button></a>
                            </body>";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro " . $Erro->getMessage();
        }
        return $Retorno;
    }

    /*-----------------------------------------------------------------------------

    public function Pesquisar()
    {
        include_once "assets/Conexao.php";

        try {


            $Comando = $conexao->prepare("select * from CLIENTES INNER JOIN LOGIN on CLIENTES.CodCliente = LOGIN.CodCliente WHERE CLIENTES.CodCliente = ?");
            $Comando->bindParam(1, $this->CodCliente);

            $Comando->execute();
            $Clientes = $Comando->fetchAll();

            $RetornoJSON = json_encode($Clientes);

            echo $RetornoJSON;
        } catch (Exception $erro) {
            $RetornoJSON = "Erro: " . $erro->getMessage();
        }
    }

    /*-----------------------------------------------------------------------------

    public function Alterar()
    {
        include_once "assets/Conexao.php";

        try {
            $Comando = $conexao->prepare("UPDATE CLIENTES SET NomeCliente = ?, CelCliente = ?, CPFCliente = ?, CEPCliente = ? WHERE CodCliente = ?");

            $Comando->bindParam(1, $this->NomeCliente);
            $Comando->bindParam(2, $this->CelCliente);
            $Comando->bindParam(3, $this->CPFCliente);
            $Comando->bindParam(4, $this->CEPCliente);
            $Comando->bindParam(5, $this->CodCliente);

            $Comando->execute();

            $Comando = $conexao->prepare("UPDATE LOGIN SET EmailCliente = ?, SenhaCliente = ? WHERE CodCliente = ?");

            $Comando->bindParam(1, $this->EmailCliente);
            $Comando->bindParam(2, $this->SenhaCliente);
            $Comando->bindParam(3, $this->CodCliente);



            if ($Comando->execute()) {
                $Retorno = "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                            <h1>Cliente atualizado com sucesso!</h1>
                            <a href='index.php'><button>Voltar ao Menu</button></a>
                            <a href='FormClientes.php'><button>Continuar Atualizando</button></a>
                            </body>";
            }
        } catch (PDOException $Erro) {
            $Retorno = "Erro " . $Erro->getMessage();
        }

        return $Retorno;
    }

    /*-----------------------------------------------------------------------------*/
}
