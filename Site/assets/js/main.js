function Carrossel() {
    var dados = 0;

    $.ajax({
        method: 'POST',
        url: '../Adm/ControleProdutos.php',
        data: { Carrossel: true },

        beforeSend: function () {
            console.log("Carregando carrossel..");
        }
    })

        .done(function (dadosPHP) {

            var Carrossel = JSON.parse(dadosPHP);

            var carouselInner = document.getElementById('carouselInner');
            var carouselIndicators = document.getElementById('carouselIndicators');

            for (var i = 0; i < Carrossel.length; i++) {
                var carouselItem = document.createElement('div');
                carouselItem.classList.add('carousel-item');
                if (i === 0) {
                    carouselItem.classList.add('active');
                }

                var img = document.createElement('img');
                img.classList.add('d-block', 'w-100');
                img.style.height = '400px';
                img.style.width = '700px';
                img.alt = '';
                img.src = 'data:image/jpeg;base64,' + Carrossel[i].Images;

                var carouselCaption = document.createElement('div');
                carouselCaption.classList.add('carousel-caption', 'd-none', 'd-md-block');
                var h5 = document.createElement('h5');
                h5.textContent = Carrossel[i].DescProduto;

                carouselCaption.appendChild(h5);
                carouselItem.appendChild(img);
                carouselItem.appendChild(carouselCaption);

                carouselInner.appendChild(carouselItem);

                var indicator = document.createElement('button');
                indicator.setAttribute('type', 'button');
                indicator.setAttribute('data-bs-target', '#carouselExampleDark');
                indicator.setAttribute('data-bs-slide-to', i.toString());
                if (i === 0) {
                    indicator.classList.add('active');
                }
                carouselIndicators.appendChild(indicator);
            }
        })

        .fail(function () {
            alert("falha na consulta");
        })

    return false;
};

function Card() {
    $.ajax({
        method: 'POST',
        url: '../Adm/ControleProdutos.php',
        data: { Card: true },
        beforeSend: function () {
            console.log("Carregando card..");
        }
    })

        .done(function (dadosPHP) {
            var cards = JSON.parse(dadosPHP);
            var cardContainer = document.getElementById('cardContainer');

            if (Array.isArray(cards)) {
                cards.forEach(function (card) {
                    var colElement = document.createElement('div');
                    colElement.classList.add('col');

                    // Crie o card
                    var cardElement = document.createElement('div');
                    cardElement.classList.add('card', 'mb-4', 'shadow-sm');
                    cardElement.style.width = '18rem';

                    // Crie a imagem do card
                    var img = document.createElement('img');
                    img.classList.add('card-img-top');
                    img.alt = '';
                    img.src = 'data:image/jpeg;base64,' + card.Images;
                    img.value = 'compra';

                    // Crie o corpo do card
                    var cardBody = document.createElement('div');
                    cardBody.classList.add('card-body');

                    // Crie o título do card que inclui DescProduto e CodProduto
                    var title = document.createElement('h5');
                    title.classList.add('card-title');
                    title.textContent = card.CodProduto + ' - ' + card.DescProduto;

                    // Crie o parágrafo para o valor do produto
                    var p = document.createElement('p');
                    p.classList.add('card-text');
                    p.textContent = 'R$: ' + card.ValProduto;

                    // Crie o botão
                    var BuyButton = document.createElement('button');
                    BuyButton.classList.add('btn', 'btn-primary');
                    BuyButton.textContent = 'Adicione ao carrinho';
                    BuyButton.addEventListener('click', function () {
                        window.location.href = '../Adm/ControleProdutos.php?Acao=carrinho&CodProduto=' + card.CodProduto;
                    });

                    cardBody.appendChild(title);
                    cardBody.appendChild(p);
                    cardBody.appendChild(BuyButton);
                    cardElement.appendChild(img);
                    cardElement.appendChild(cardBody);


                    colElement.appendChild(cardElement);
                    cardContainer.appendChild(colElement);
                });
            }


        })

        .fail(function () {
            alert("falha na consulta");
        })

    return false;
};

