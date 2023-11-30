function Pesquisar() {
    var dados = $('#FormCliente').serialize();
    console.log("Ajax request starting ...");

    $.ajax({
        method: 'POST',
        url: 'ControleClientes.php',
        data: dados + '&Pesquisar=true',

        beforeSend: function () {
            console.log("Carregando consulta..");
        }
    })

        .done(function (dadosPHP) {
            console.log("Response received1:", dadosPHP);
            var Alunos = JSON.parse(dadosPHP);
            //Consulta em Formulario
            document.getElementById('NomeCliente').value = Alunos[0].NomeCliente;
            document.getElementById('CelCliente').value = Alunos[0].CelCliente;
            document.getElementById('CPFCliente').value = Alunos[0].CPFCliente;
            document.getElementById('CEPCliente').value = Alunos[0].CEPCliente;
            document.getElementById('EmailCliente').value = Alunos[0].EmailCliente;
            document.getElementById('SenhaCliente').value = Alunos[0].SenhaCliente;

        })

        .fail(function () {
            alert("falha na consulta");
        })

    return false;
};


function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('rua').value = ("");
    document.getElementById('bairro').value = ("");
    document.getElementById('cidade').value = ("");
    document.getElementById('uf').value = ("");
    document.getElementById('ibge').value = ("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('rua').value = (conteudo.logradouro);
        document.getElementById('bairro').value = (conteudo.bairro);
        document.getElementById('cidade').value = (conteudo.localidade);
        document.getElementById('uf').value = (conteudo.uf);
        document.getElementById('ibge').value = (conteudo.ibge);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('rua').value = "...";
            document.getElementById('bairro').value = "...";
            document.getElementById('cidade').value = "...";
            document.getElementById('uf').value = "...";
            document.getElementById('ibge').value = "...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};
