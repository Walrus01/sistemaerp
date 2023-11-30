<?php

class clsClientes
{

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

    private $CelCliente;

    public function setCelCliente($CelCli)
    {
        $this->CelCliente = $CelCli;
    }

    public function getCelCliente()
    {
        return $this->CelCliente;
    }

    /*-----------------------------------------------------------------------------*/

    private $CPFCliente;

    public function setCPFCliente($CPFCli)
    {
        $this->CPFCliente = $CPFCli;
    }

    public function getCPFCliente()
    {
        return $this->CPFCliente;
    }

    /*-----------------------------------------------------------------------------*/

    private $CEPCliente;

    public function setCEPCliente($CEPCli)
    {
        $this->CEPCliente = $CEPCli;
    }

    public function getCEPCliente()
    {
        return $this->CEPCliente;
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

    private $SenhaCliente;

    public function setSenhaCliente($SenhaCli)
    {
        $this->SenhaCliente = $SenhaCli;
    }

    public function getSenhaCliente()
    {
        return $this->SenhaCliente;
    }

    /*-----------------------------------------------------------------------------*/

    public function Incluir()
    {

        include_once "assets/Conexao.php";

        try {

            $Comando = $conexao->prepare("insert into CLIENTES (CodCliente,NomeCliente,CelCliente,CPFCliente,CEPCliente) values (?,?,?,?,?)");
            $Comando->bindParam(1, $this->CodCliente);
            $Comando->bindParam(2, $this->NomeCliente);
            $Comando->bindParam(3, $this->CelCliente);
            $Comando->bindParam(4, $this->CPFCliente);
            $Comando->bindParam(5, $this->CEPCliente);

            $Comando->execute();

            $Comando = $conexao->prepare("insert into LOGIN (CodCliente, EmailCLiente,SenhaCliente) values (?,?,?)");
            $Comando->bindParam(1, $this->CodCliente);
            $Comando->bindParam(2, $this->EmailCliente);
            $Comando->bindParam(3, $this->SenhaCliente);


            if ($Comando->execute()) {
                $Retorno = "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                            <h1>Cliente cadastrado com sucesso!</h1>
                            <a href='index.php'><button>Voltar ao Menu</button></a>
                            <a href='FormClientes.php'><button>Continuar Cadastrando</button></a>
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
            $Comando = $conexao->prepare("delete from CLIENTES where CodCliente = ?");
            $Comando->bindParam(1, $this->CodCliente);

            $Comando->execute();

            $Comando = $conexao->prepare("delete from LOGIN where CodCliente = ?");
            $Comando->bindParam(1, $this->CodCliente);

            if ($Comando->execute()) {
                $Retorno = "<body style='background-color:#1e293b;color: white;text-align: center;margin-top: 15%'>
                            <h1>Cliente deletado com sucesso!</h1>
                            <a href='index.php'><button>Voltar ao Menu</button></a>
                            <a href='FormClientes.php'><button>Continuar Deletando</button></a>
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

    /*-----------------------------------------------------------------------------*/

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

    public function Login()
    {
        include_once "assets/Conexao.php";

        $Comando = $conexao->prepare("select CodCliente, EmailCliente, SenhaCliente from LOGIN where EmailCliente = ? and SenhaCliente = ?");
        $Comando->bindParam(1, $this->EmailCliente);
        $Comando->bindParam(2, $this->SenhaCliente);
        $Comando->execute();

        $Linha = $Comando->rowCount();



        if ($Linha > 0) {

            $resultado = $Comando->fetch(PDO::FETCH_ASSOC);
            $Cod = $resultado['CodCliente'];


            $Comando = $conexao->prepare("select NomeCliente from CLIENTES where CodCliente = ?");
            $Comando->bindParam(1, $Cod);
            $Comando->execute();


            $Resultado = $Comando->fetch(PDO::FETCH_ASSOC);
            $NomeCliente = $Resultado['NomeCliente'];
            $_SESSION['EmailCliente'] = $this->EmailCliente;
            $_SESSION['NomeCliente'] = $NomeCliente;
            $_SESSION['SenhaCliente'] = $this->SenhaCliente;
            header('location: ../Site/index.php');
        } else {
            unset($_SESSION['EmailCliente']);
            unset($_SESSION['NomeCliente']);
            unset($_SESSION['SenhaCliente']);
            header('location: ../Site/login.php');
        }
    }

    /*-----------------------------------------------------------------------------*/

    public function Logout()
    {

        unset($_SESSION['EmailCliente']);
        unset($_SESSION['NomeCliente']);
        unset($_SESSION['SenhaCliente']);
        header('location: ../Site/login.php');
    }

    /*-----------------------------------------------------------------------------*/
}
