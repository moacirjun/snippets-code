var carroselBanner = document.querySelector(".container-slide");

if (carroselBanner !== null && carroselBanner !== "undefined") {
    var qtdeImgs = carroselBanner.childElementCount;
    var imgAtual = 1;
    var qtdeImages = carroselBanner.childElementCount;
    var intervaloAnimacao;

    definirAnimacaoBanner();
    criarIndicadorBanner()
}

function definirAnimacaoBanner() {
    if (carroselBanner === null || carroselBanner === 'undefined') {
        return
    }
    intervaloAnimacao = setInterval(correBanner, 7000)
};

function correBanner() {
    if (imgAtual >= qtdeImages) {
        imgAtual = 0
    }
    var indicadorAtivo = document.querySelector(".indicator-item.active");
    var indicadores = document.querySelectorAll(".indicator-item");
    var imagens = carroselBanner.querySelectorAll("img");

    indicadorAtivo.classList.remove("active");
    indicadores[imgAtual].classList.add("active");

    imagens.forEach((img) => {
        img.classList.remove("active")
    });

    imagens[imgAtual].classList.add("active");
    imgAtual++
};

function gotoBanner(button) {
    var id = button.getAttribute("data-value");
    clearInterval(intervaloAnimacao);
    imgAtual = id - 1;
    correBanner();
    definirAnimacaoBanner()
};

function nextPreviousBanner(button) {
    var value = button.getAttribute("data-value");
    if (value === "next") {
        if (imgAtual >= qtdeImages) {
            imgAtual = 0
        }
    } else if (value === "previous") {
        if (imgAtual <= 1) {
            imgAtual = qtdeImages - 1
        } else {
            imgAtual = imgAtual - 2
        }
    }
    clearInterval(intervaloAnimacao);
    correBanner();
    definirAnimacaoBanner()
}

function criarIndicadorBanner() {
    var containerIndicators = document.querySelector(".slide-indicator");

    for (var i = 1; i <= qtdeImages; i++) {
        var indicator = document.createElement("div");
        
        indicator.classList.add("indicator-item");
        if (i === 1) indicator.classList.add("active");
        indicator.setAttribute("data-value", i);
        indicator.setAttribute("data-values", "teste");
        indicator.setAttribute("onclick", "gotoBanner(this)");
        containerIndicators.appendChild(indicator)
    }
}