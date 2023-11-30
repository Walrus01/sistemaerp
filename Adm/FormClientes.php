<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css" media="screen" />
    <link rel="shortcut icon" href="assets/images/bag.png">
    <script src="assets/js/Cliente.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</head>

<body>

    <header><?php include "assets/navbar/NavBar.php"; ?></header>

    <form action="ControleClientes.php" method="POST" name="FormCliente" id="FormCliente">

        <div class="container my-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="color-secondary card p-2 rounded-3 shadow-lg" data-bs-theme="dark">
                        <div class="card-body">
                            <h4 class="color-tertiary card-title mb-3">CADASTRO DE CLIENTES</h4>
                            <div class="row">
                                <div class="col">
                                    <input class="color-primary form-control border border-light p-2" type="number" name="CodCliente" id="CodCliente" min="1" max="99999" placeholder="Código do Cliente" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" type="text" name="NomeCliente" id="NomeCliente" placeholder="Nome Cliente" maxlength="100"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" type="text" name="EmailCliente" id="EmailCliente" placeholder="Email" maxlength="100"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" type="password" name="SenhaCliente" id="SenhaCliente" placeholder="Senha" maxlength="100"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" type="text" name="CelCliente" id="CelCliente" min=100000000 max=999999999 step="0" placeholder="Celular"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" type="text" placeholder="CPF" name="CPFCliente" id="CPFCliente" min=10000000000 max=99999999999 step="0"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" placeholder="CEP" name="CEPCliente" type="text" id="CEPCliente" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" placeholder="Rua" name="rua" type="text" id="rua" size="60"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" placeholder="Bairro" name="bairro" type="text" id="bairro" size="40"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" placeholder="Cidade" name="cidade" type="text" id="cidade" size="40"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" placeholder="UF" name="uf" type="text" id="uf" size="2"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="input-group"> <input class="color-primary form-control border border-light p-2" placeholder="IBGE" name="ibge" type="text" id="ibge" size="8"> </div><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="input-group justify-content-center">
                                        <button class="btn btn-outline-light me-2" type="submit" name="Incluir">Incluir</button>
                                        <button class="btn btn-outline-light me-2" type="reset" name="Limpar">Limpar</button>
                                        <button class="btn btn-outline-light me-2" type="submit" name="Excluir">Excluir</button>
                                        <button class="btn btn-outline-light me-2" type="button" value="Pesquisar" onclick="Pesquisar();">Pesquisar</button>
                                        <button class="btn btn-outline-light me-2" type="submit" name="Alterar">Alterar</button>
                                        <button class="btn btn-outline-light me-2" type="button" name="Voltar" onclick="window.history.back();">Voltar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>