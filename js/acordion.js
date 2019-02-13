var botoes = document.querySelectorAll("[btn-accordion]");

function getContainer(btn) {
    var dataApto = btn.getAttribute("data-target");
    return document.getElementById(dataApto);
}

function selecionarContainer(btn) {
    btn.classList.add("selected");
    getContainer(btn).classList.add("selected");
}

function deselecionarContainers() {
    botoes.forEach(btn => {
        btn.classList.remove("selected");
        getContainer(btn).classList.remove("selected");
    });
}

function definirOnclickBtns() {
    
    botoes.forEach( btn => {

        var vOnclick = () => {
            deselecionarContainers();
            selecionarContainer(btn);
        };

        btn.addEventListener("click", vOnclick);
        console.log(btn);
    });
}
definirOnclickBtns();