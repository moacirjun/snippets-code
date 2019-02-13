var accordions = document.querySelectorAll("[accordion-element]");
if (accordions !== null && accordions.length > 0) {
    accordions.forEach( (component) => {
        var botoes = component.querySelectorAll("[btn-accordion]");

        function getContainer(btn) {
            var dataApto = btn.getAttribute("data-target");
            return component.getElementById(dataApto);
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
    });
}