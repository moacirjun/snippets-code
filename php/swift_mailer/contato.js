
forms = document.querySelectorAll("form[method=post]");
forms.forEach((form) => {
    var btnHorario = form.querySelector('#botao-hora'),
        listaHoras = form.querySelector('#lista-horas'),
        horasItems = listaHoras.querySelectorAll('li'),
        horaDefinida = form.querySelector('#hora-definida'),
        horaDefinidaText = horaDefinida.querySelector('.form-text'),
        btnsModoContato = form.querySelectorAll('.item.modo-contato');

    function fecharLista() {
        listaHoras.classList.remove('show')
    }

    function mostrarLista() {
        listaHoras.classList.add('show')
    }
    const btnOnclick = () => {
        if (listaHoras.classList.contains('show')) {
            fecharLista()
        } else {
            mostrarLista()
        }
    }
    btnHorario.addEventListener('click', btnOnclick);

    function deselecionarOutrasHoras(item) {
        horasItems.forEach((hora) => {
            if (item !== hora) {
                hora.querySelector('input').checked = !1;
                hora.classList.remove('actived')
            }
        })
    }

    function marcarHoraDefinada(item) {
        horaDefinida.classList.add('show');
        horaDefinidaText.innerText = item.querySelector('.form-text').innerText
    }

    function desmarcarHoraDefinada(item) {
        horaDefinida.classList.remove('show');
        horaDefinidaText.innerText = ""
    }
    const itemClick = (item) => {
        if (item.classList.contains('actived')) {
            desmarcarHoraDefinada(item);
            item.classList.remove('actived');
            item.querySelector('input').checked = !1;
            removerInputHidden('horario', item.querySelector('.form-text').innerText)
        } else {
            item.classList.add('actived');
            item.querySelector('input').checked = !0;
            marcarHoraDefinada(item);
            deselecionarOutrasHoras(item);
            removerTodosInputsHorario();
            criarInputHidden('horario', item.querySelector('.form-text').innerText)
        }
        setTimeout(fecharLista, 200)
    }
    
    function criarInputHidden(name, value) {
        var input = document.createElement("input");
        input.name = name;
        input.value = value;
        input.type = "hidden";
        form.appendChild(input)
    }

    function removerInputHidden(name, value) {
        var input = form.querySelector("input[type=hidden][name='" + name + "'][value='" + value + "']");
        if (input !== null && input !== "undefined") {
            input.remove()
        }
    }

    function removerTodosInputsHorario() {
        var inputs = form.querySelectorAll("input[type=hidden][name='horario']");
        inputs.forEach((input) => {
            input.remove()
        })
    }
    horasItems.forEach((item) => {
        var oc = () => {
            itemClick(item)
        }
        item.addEventListener('click', oc)
    });
    const btnModoContOnclick = (btnModoCont) => {
        if (btnModoCont.classList.contains('active')) {
            btnModoCont.classList.remove('active');
            removerInputHidden('modo-contato[]', btnModoCont.querySelector('.content').innerText)
        } else {
            btnModoCont.classList.add('active');
            criarInputHidden('modo-contato[]', btnModoCont.querySelector('.content').innerText)
        }
    }
    btnsModoContato.forEach((btn) => {
        var oc = () => {
            btnModoContOnclick(btn)
        }
        btn.addEventListener('click', oc);
    });

    function horarioExist() {
        var horario = form.querySelector("input[type=hidden][name='horario']");
        if (horario === null) {
            alert("Você esqueceu de escolher um horário para a gente entrar em contato com você!");
            btnHorario.click();
            return !1
        }
        return !0
    }

    function modoExist() {
        var modos = form.querySelectorAll("input[type=hidden][name='modo-contato[]']");
        if (modos.length <= 0) {
            alert("Você esqueceu de escolher qual a melhor maneira que a gente pode entrar em contato com você!");
            btnsModoContato[0].focus();
            return !1
        }
        return !0
    }

    function termsChecked() {
        var terms = form.querySelector("input[type=checkbox][name='terms']");
        if (terms.checked === !1) {
            alert("Você esqueceu de aceitar nossos termos de serviços!");
            terms.focus();
            return !1
        }
        return !0
    }

    function formSubmit() {
        return horarioExist() && modoExist() && termsChecked()
    }
    
     form.onsubmit = formSubmit
})