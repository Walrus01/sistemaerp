function Pesquisar() {
    var dados = $('#FormVendas').serialize();
    console.log("Ajax request starting...");

    $.ajax({
        method: 'POST',
        url: 'ControleVendas.php',
        data: dados + '&Pesquisar=true',

        beforeSend: function () {
            console.log("Carregando consulta..");
        }
    })

        .done(function (dadosPHP) {
            console.log("Response received:", dadosPHP);
            var Alunos = JSON.parse(dadosPHP);
            //Consulta em Formulario
            document.getElementById('CodCliente').value = Alunos[0].CodCliente;
            document.getElementById('CodProduto').value = Alunos[0].CodProduto;
            document.getElementById('QuantVenda').value = Alunos[0].QuantVenda;
            document.getElementById('DataVenda').value = Alunos[0].DataVenda;

            if (Alunos[0].FormaPagto === "V") {
                document.getElementById('Avista').checked = true;
            } else {
                document.getElementById('Aprazo').checked = true;
            }

        })

        .fail(function () {
            alert("falha na consulta");
        })

    return false;
};

function PesquisarNome() {

    var dados = $('#FormVendas').serialize();
    console.log("Ajax request starting...");

    $.ajax({
        method: 'POST',
        url: 'ControleVendas.php',
        data: dados + '&PesquisarNome=true',

        beforeSend: function () {
            console.log("Carregando consulta..");
        }
    })

        .done(function (dadosNome) {
            console.log("Response received:", dadosNome);
            var Alunos = JSON.parse(dadosNome);
            //Consulta em Formulario
            document.getElementById('NomeCliente').value = Alunos[0].NomeCliente;
        })

        .fail(function () {
            alert("falha na consulta");
        })

    return false;

};

function PesquisarDesc() {

    var dados = $('#FormVendas').serialize();
    console.log("Ajax request starting...");

    $.ajax({
        method: 'POST',
        url: 'ControleVendas.php',
        data: dados + '&PesquisarDesc=true',

        beforeSend: function () {
            console.log("Carregando consulta..");
        }
    })

        .done(function (dadosDesc) {
            console.log("Response received:", dadosDesc);
            var Alunos = JSON.parse(dadosDesc);
            //Consulta em Formulario
            document.getElementById('DescProduto').value = Alunos[0].DescProduto;
        })

        .fail(function () {
            alert("falha na consulta");
        })

    return false;

};