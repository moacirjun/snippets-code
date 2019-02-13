var carrousels = [];

class carrouselDestaque {
    constructor (carrouselElement) {
        this.id = carrousels.length;
        this.element = carrouselElement;
        this.container = carrouselElement.querySelector("#carrousel-container");
        this.lista = carrouselElement.querySelector("#carrousel-container ul");
        this.imagemDestaque = carrouselElement.querySelector("#carousel .imagem-destacada");
        this.total = carrouselElement.querySelector("#carrousel-container ul").childElementCount;
        this.marginRightItems = 16;
        this.ultimoVisivel = 4;
        this.numClones = 0;
        this.numVisivel = 4;
        this.atual = 0;
        this.transitionTime = 500;

        this.initialize();
    }

    initialize() {
        if (this.isInfinite()) {
            this.definirQtdeClone();
            this.criarClones();
        } 
        this.definirIndexDosItems();
        this.destacarItemAtual();
        this.destacarImagemDoSlideAtual();
        this.definirOnclickItems();
    
        window.addEventListener("load", () => {
            carrouselDestaque.definirTamanhos(this);
            this.definirOnclickBtns();
        });
        window.addEventListener("resize", () => {
            carrouselDestaque.definirTamanhos(this);
        });
    }

    static definirTamanhos(carrouselObj) {
        carrouselObj.definirLarguraItems();
        carrouselObj.mover(carrouselObj.atual);
    }

    get postToCenter() {
        return (window.screen.width/2) - (this.elementActiveWidth/2);
    }

    get slideAtual() {
        return this.element.querySelectorAll(".carousel-item")[this.atual + this.numClones];
    }

    get slides() {
        return this.element.querySelectorAll(".carousel-item");
    }

    get elementWidth() {
        var container = this.container;
        var containerWidth = container.offsetWidth;
        while (containerWidth === 0 && container !== document.body) {
            container = container.parentNode;
            containerWidth = container.offsetWidth;
        }

        return ((containerWidth) / this.numVisivel) - 16;
    }

    static mostrarProximo(carrousel) {
        if (!carrousel.isInfinite() && carrousel.atual === carrousel.total-1) {
            carrousel.atual = 0;
        }
        else {
            carrousel.atual += 1;
        }
        carrousel.processoDeMover();
    }

    static mostrarAnterior(carrousel) {
        if (!carrousel.isInfinite() && carrousel.atual === 0) {
            carrosel.atual = carrousel.total-1;
        }
        else {
            carrousel.atual -= 1;
        }
        carrousel.processoDeMover();
    }

    static mostrarClicado(carrouselObj, index) {
        carrouselObj.atual=index;
        carrouselObj.processoDeMover();
    }

    processoDeMover() {
        this.destacarItemAtual();
        this.destacarImagemDoSlideAtual();
        if (this.isInfinite()) {
            this.mover(this.atual);
            setTimeout( 
                () => {
                    this.verificarSlideAtualClone();
                },
                this.transitionTime
            );
        }
    }

    isInfinite() {
        return this.total > this.numVisivel;
    }

    mover(index) {
        index += this.numClones;

        var translateX = (this.elementWidth + this.marginRightItems) * index;
        translateX *= -1;

        this.lista.style = "transform : translate3d(" + translateX + "px, 0, 0);";
    }

    moverSemAnimacao(index) {
        index += this.numClones;

        var translateX = (this.elementWidth + this.marginRightItems) * index;
        translateX *= -1;

        this.lista.style = "transform : translate3d(" + translateX + "px, 0, 0); transition-duration : 0s !important;";
    }

    verificarSlideAtualClone() {
        if (this.atual < 0) {
            this.atual = this.total + this.atual;
            this.moverSemAnimacao(this.atual);
        }
        else if (this.atual > this.total-1) {
            this.atual = this.atual - this.total;
            this.moverSemAnimacao(this.atual);
        }
    }

    definir_qtde_visivel() {
        if (window.screen.width < 700) {
            this.numVisivel = 1
        } else if (window.screen.width >= 700 && window.screen.width < 900) {
            this.numVisivel = 2
        } else if (window.screen.width >= 900) {
            this.numVisivel = 3
        }
    }

    definirQtdeClone() {
        this.numClones = this.total;
    }

    criarClones() {
        var qtdeClones = this.numClones;
        var arraySlides = this.container.querySelectorAll("li");
        var arraySlidesEClones = [];

        for (var i = this.total - qtdeClones; i < this.total; i++) {
            var slidet = arraySlides[i].cloneNode(true);
            slidet.classList.add("cloned");

            arraySlidesEClones.push(slidet);
        }
        
        arraySlides.forEach( (slide) => {
            var novoSlide = slide.cloneNode(true);

            arraySlidesEClones.push(novoSlide);
        });
        
        for (var i = 0; i < qtdeClones; i++) {
            var slide = arraySlides[i].cloneNode(true);
            slide.classList.add("cloned");

            arraySlidesEClones.push(slide);
        }
        
        this.container.querySelector("ul").innerHTML = "";
        
        arraySlidesEClones.forEach( (slide) => {
            this.container.querySelector("ul").appendChild(slide);
        });
    }

    destacarImagemDoSlideAtual() {
        var newImage = this.slideAtual.querySelector("img").cloneNode(true);
        var imagemDestacada = this.imagemDestaque.querySelector("img");

        if (imagemDestacada !== null & imagemDestacada !== "undefined") {
            imagemDestacada.classList.add("hide");
            setTimeout( () => {
                imagemDestacada.remove();
            }, this.transitionTime);
            this.imagemDestaque.insertBefore(newImage, imagemDestacada);
        }
        else {
            this.imagemDestaque.appendChild(newImage);
        }
    }

    destacarItemAtual() {
        this.slides.forEach( slide => {
            slide.classList.remove("selected");
        });
        this.slideAtual.classList.add("selected");
    }

    definirLarguraItems() {
        var items = this.element.querySelectorAll(".carousel-item");
        items.forEach((item) => {
            item.style.width = this.elementWidth + "px";
        });
    }

    definirIndexDosItems() {
        var items = this.container.querySelectorAll("li");
        var index = 0 - (this.numClones);

        items.forEach((item) => {
            item.setAttribute("data-index", index);
            index++;
        });
    }

    definirOnclickItems() {
        var items = this.element.querySelectorAll(".carousel-item");
        items.forEach((item) => {

            var oc = (event) => {
                var botao=event.target;
                while(botao.tagName!=="LI"&&botao!==document.body) {
                    botao=botao.parentNode
                }
                var index=parseInt(botao.getAttribute("data-index"));

                carrouselDestaque.mostrarClicado(this, index);
            };

            item.addEventListener("click", oc);
        });
    }

    definir_largura_items_sem_animacao() {
        var items = this.element.querySelectorAll(".carousel-item");
        items.forEach((item) => {
            item.style = "width : " + this.elementWidth + "px; transition-duration : 0s !important;";
            setTimeout( () => {item.style = "width : " + this.elementWidth + "px";}, 10);
        });
    }
    
    definir_altura_min() {
        this.container.querySelector("ul").style.minHeight = this.element.offsetHeight + "px";
    }

    definirOnclickBtns() {
        var btns = this.element.querySelectorAll(".btn");

        var oc = (Evt) => {
            var botao = Evt.target;
            while (!botao.classList.contains("btn")) {
                botao = botao.parentNode;
            }

            if (botao.getAttribute("data-target") === "previous") {
                carrouselDestaque.mostrarAnterior(this);
            }
            else if (botao.getAttribute("data-target") === "next") {
                carrouselDestaque.mostrarProximo(this);
            }
        };

        btns.forEach( (btn) => {
            btn.addEventListener("click", oc);
        });
    }
}

var arrayCarrousel = document.querySelectorAll("[carrousel-element]");

if (arrayCarrousel.length > 0) {
    arrayCarrousel.forEach( (carrouselElement) => {
        var carrousel = new carrouselDestaque(carrouselElement);
        carrousels.push(carrousel);
    });
}

function definirReinicializacao() {
    var botoes = document.querySelectorAll("[ data-function=\"initCarrousel\"]");
    botoes.forEach( btn => {
        btn.addEventListener("click", () => {
            var index = btn.getAttribute("data-car-id");
            carrouselDestaque.definirTamanhos(carrousels[index]);
        });
    });
}
definirReinicializacao();