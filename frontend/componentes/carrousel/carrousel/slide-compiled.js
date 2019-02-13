var _createClass=function(){function a(b,c){for(var e,d=0;d<c.length;d++)e=c[d],e.enumerable=e.enumerable||!1,e.configurable=!0,"value"in e&&(e.writable=!0),Object.defineProperty(b,e.key,e)}return function(b,c,d){return c&&a(b.prototype,c),d&&a(b,d),b}}();function _classCallCheck(a,b){if(!(a instanceof b))throw new TypeError("Cannot call a class as a function")}var carrousels=[],carrouselDestaque=function(){function a(b){_classCallCheck(this,a),this.id=carrousels.length,this.element=b,this.container=b.querySelector("#carrousel-container"),this.lista=b.querySelector("#carrousel-container ul"),this.imagemDestaque=b.querySelector("#carousel .imagem-destacada"),this.total=b.querySelector("#carrousel-container ul").childElementCount,this.marginRightItems=16,this.ultimoVisivel=4,this.numClones=0,this.numVisivel=4,this.atual=0,this.transitionTime=500,this.initialize()}return _createClass(a,[{key:"initialize",value:function initialize(){var b=this;this.isInfinite()&&(this.definirQtdeClone(),this.criarClones()),this.definirIndexDosItems(),this.destacarItemAtual(),this.destacarImagemDoSlideAtual(),this.definirOnclickItems(),window.addEventListener("load",function(){a.definirTamanhos(b),b.definirOnclickBtns()}),window.addEventListener("resize",function(){a.definirTamanhos(b)})}},{key:"processoDeMover",value:function processoDeMover(){var b=this;this.destacarItemAtual(),this.destacarImagemDoSlideAtual(),this.isInfinite()&&(this.mover(this.atual),setTimeout(function(){b.verificarSlideAtualClone()},this.transitionTime))}},{key:"isInfinite",value:function isInfinite(){return this.total>this.numVisivel}},{key:"mover",value:function mover(b){b+=this.numClones;var c=(this.elementWidth+this.marginRightItems)*b;c*=-1,this.lista.style="transform : translate3d("+c+"px, 0, 0);"}},{key:"moverSemAnimacao",value:function moverSemAnimacao(b){b+=this.numClones;var c=(this.elementWidth+this.marginRightItems)*b;c*=-1,this.lista.style="transform : translate3d("+c+"px, 0, 0); transition-duration : 0s !important;"}},{key:"verificarSlideAtualClone",value:function verificarSlideAtualClone(){0>this.atual?(this.atual=this.total+this.atual,this.moverSemAnimacao(this.atual)):this.atual>this.total-1&&(this.atual-=this.total,this.moverSemAnimacao(this.atual))}},{key:"definir_qtde_visivel",value:function definir_qtde_visivel(){700>window.screen.width?this.numVisivel=1:700<=window.screen.width&&900>window.screen.width?this.numVisivel=2:900<=window.screen.width&&(this.numVisivel=3)}},{key:"definirQtdeClone",value:function definirQtdeClone(){this.numClones=this.total}},{key:"criarClones",value:function criarClones(){for(var f,h=this,b=this.numClones,c=this.container.querySelectorAll("li"),d=[],e=this.total-b;e<this.total;e++)f=c[e].cloneNode(!0),f.classList.add("cloned"),d.push(f);c.forEach(function(j){var k=j.cloneNode(!0);d.push(k)});for(var g,e=0;e<b;e++)g=c[e].cloneNode(!0),g.classList.add("cloned"),d.push(g);this.container.querySelector("ul").innerHTML="",d.forEach(function(j){h.container.querySelector("ul").appendChild(j)})}},{key:"destacarImagemDoSlideAtual",value:function destacarImagemDoSlideAtual(){var b=this.slideAtual.querySelector("img").cloneNode(!0),c=this.imagemDestaque.querySelector("img");null!==c&"undefined"!==c?(c.classList.add("hide"),setTimeout(function(){c.remove()},this.transitionTime),this.imagemDestaque.insertBefore(b,c)):this.imagemDestaque.appendChild(b)}},{key:"destacarItemAtual",value:function destacarItemAtual(){this.slides.forEach(function(b){b.classList.remove("selected")}),this.slideAtual.classList.add("selected")}},{key:"definirLarguraItems",value:function definirLarguraItems(){var c=this,b=this.element.querySelectorAll(".carousel-item");b.forEach(function(d){d.style.width=c.elementWidth+"px"})}},{key:"definirIndexDosItems",value:function definirIndexDosItems(){var b=this.container.querySelectorAll("li"),c=0-this.numClones;b.forEach(function(d){d.setAttribute("data-index",c),c++})}},{key:"definirOnclickItems",value:function definirOnclickItems(){var c=this,b=this.element.querySelectorAll(".carousel-item");b.forEach(function(d){d.addEventListener("click",function e(f){for(var g=f.target;"LI"!==g.tagName&&g!==document.body;)g=g.parentNode;var h=parseInt(g.getAttribute("data-index"));a.mostrarClicado(c,h)})})}},{key:"definir_largura_items_sem_animacao",value:function definir_largura_items_sem_animacao(){var c=this,b=this.element.querySelectorAll(".carousel-item");b.forEach(function(d){d.style="width : "+c.elementWidth+"px; transition-duration : 0s !important;",setTimeout(function(){d.style="width : "+c.elementWidth+"px"},10)})}},{key:"definir_altura_min",value:function definir_altura_min(){this.container.querySelector("ul").style.minHeight=this.element.offsetHeight+"px"}},{key:"definirOnclickBtns",value:function definirOnclickBtns(){var d=this,b=this.element.querySelectorAll(".btn"),c=function(e){for(var f=e.target;!f.classList.contains("btn");)f=f.parentNode;"previous"===f.getAttribute("data-target")?a.mostrarAnterior(d):"next"===f.getAttribute("data-target")&&a.mostrarProximo(d)};b.forEach(function(e){e.addEventListener("click",c)})}},{key:"postToCenter",get:function get(){return window.screen.width/2-this.elementActiveWidth/2}},{key:"slideAtual",get:function get(){return this.element.querySelectorAll(".carousel-item")[this.atual+this.numClones]}},{key:"slides",get:function get(){return this.element.querySelectorAll(".carousel-item")}},{key:"elementWidth",get:function get(){for(var b=this.container,c=b.offsetWidth;0===c&&b!==document.body;)b=b.parentNode,c=b.offsetWidth;return c/this.numVisivel-16}}],[{key:"definirTamanhos",value:function definirTamanhos(b){b.definirLarguraItems(),b.mover(b.atual)}},{key:"mostrarProximo",value:function mostrarProximo(b){b.isInfinite()||b.atual!==b.total-1?b.atual+=1:b.atual=0,b.processoDeMover()}},{key:"mostrarAnterior",value:function mostrarAnterior(b){b.isInfinite()||0!==b.atual?b.atual-=1:carrosel.atual=b.total-1,b.processoDeMover()}},{key:"mostrarClicado",value:function mostrarClicado(b,c){b.atual=c,b.processoDeMover()}}]),a}(),arrayCarrousel=document.querySelectorAll("[carrousel-element]");0<arrayCarrousel.length&&arrayCarrousel.forEach(function(a){var b=new carrouselDestaque(a);carrousels.push(b)});function definirReinicializacao(){var a=document.querySelectorAll("[ data-function=\"initCarrousel\"]");a.forEach(function(b){b.addEventListener("click",function(){var c=b.getAttribute("data-car-id");carrouselDestaque.definirTamanhos(carrousels[c])})})}definirReinicializacao();