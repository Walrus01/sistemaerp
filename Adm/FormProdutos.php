<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css" media="screen" />
    <link rel="shortcut icon" href="assets/images/bag.png">
    <script src="assets/js/Produtos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</head>

<body class="color-primary">

    <header><?php include "assets/navbar/NavBar.php"; ?></header>

    <form action="ControleProdutos.php" method="POST" name="FormProdutos" id="FormProdutos" enctype="multipart/form-data">
        <div class="container mt-5 mb-5 d-flex justify-content-center">
            <div class="color-secondary card px-4 py-5 border border-light p-2 rounded-3" data-bs-theme="dark">
                <div class="card-body">
                    <h4 class="color-tertiary card-title mb-4">CADASTRO DE PRODUTOS</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="color-primary form-control border border-light p-2" type="number" name="CodProduto" id="CodProduto" min=1 max=99999 step="0" placeholder="Código" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="color-primary form-control border border-light p-2" type="text" name="DescProduto" id="DescProduto" maxlength="40" placeholder="Descrição">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="color-primary form-control border border-light p-2" type="text" name="ValProduto" id="ValProduto" min=1 max=999 step="0.01" placeholder="Valor">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="color-primary form-control border border-light p-2" type="text" name="VenctoProduto" id="VenctoProduto" placeholder="Vencimento" onfocus="(this.type='date')">
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group justify-content-center">
                                    <input class="color-primary  border border-light py-6" type="file" name="Arquivo" id="Arquivo" placeholder="Imagem" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="color-primary form-control border border-light p-2" type="text" name="NomeImagem" id="NomeImagem" placeholder="Nome da Imagem" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mt-5">
                                <div class="input-group justify-content-center">
                                    <button class="btn btn-outline-light" type="submit" name="Incluir">Incluir</button>
                                    <button class="btn btn-outline-light" type="reset" name="Limpar">Limpar</button>
                                    <button class="btn btn-outline-light" type="submit" name="Excluir">Excluir</button>
                                    <button class="btn btn-outline-light" type="button" value="Pesquisar" onclick="Pesquisar();">Pesquisar</button>
                                    <button class="btn btn-outline-light" type="submit" name="Alterar">Alterar</button>
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