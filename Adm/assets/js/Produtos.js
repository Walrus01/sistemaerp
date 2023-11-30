function Pesquisar() {
    var dados = $('#FormProdutos').serialize();
    console.log("Ajax request starting...");

    $.ajax({
        method: 'POST',
        url: 'ControleProdutos.php',
        data: dados + '&Pesquisar=true',

        beforeSend: function () {
            console.log("Carregando consulta..");
        }
    })

        .done(function (dadosPHP) {

            console.log("Response received:", dadosPHP);
            var Produtos = JSON.parse(dadosPHP);
            //Consulta em Formulario
            document.getElementById('DescProduto').value = Produtos[0].DescProduto;
            document.getElementById('ValProduto').value = Produtos[0].ValProduto;
            document.getElementById('VenctoProduto').value = Produtos[0].VenctoProduto;
            document.getElementById('NomeImagem').value = Produtos[0].Images_txt;

        })

        .fail(function () {
            alert("falha na consulta");
        })

    return false;
};


