var botoes = document.querySelectorAll(".btnApto"),
    botoesScroll = document.querySelectorAll(".btnAptoScroll"),
    btnApto81 = document.getElementById("btnAtpo81"),
    btnApto131 = document.getElementById("btnAtpo131"),
    btnApto140 = document.getElementById("btnAtpo140"),
    containerApto81 = document.querySelector(".sobre[data-target='apto81']"),
    containerApto131 = document.getElementById(".sobre[data-target='apto131']"),
    containerApto140 = document.getElementById(".sobre[data-target='apto140']");

function getContainer(btn) {
    var dataApto = btn.getAttribute("data-target");
    return document.getElementById(dataApto)
}

function getBtnApto(btn) {
    var dataApto = btn.getAttribute("data-target");
    return document.querySelector(".btnApto[data-target='" + dataApto + "']")
}

function scrollToFichaTecnica() {
    var ficharTecnica = document.getElementById("fichatecnica");
    var yPos = getPosition(ficharTecnica).y + window.scrollY - 100;
    window.scroll({
        top: yPos,
        behavior: "smooth"
    })
}

function selecionarApto(btn) {
    btn.classList.add("selected");
    getContainer(btn).classList.add("selected")
}

function deselecionarAptos() {
    botoes.forEach(btn => {
        btn.classList.remove("selected");
        getContainer(btn).classList.remove("selected")
    })
}

function definirOnclickBtns() {
    botoes.forEach(btn => {
        var vOnclick = () => {
            deselecionarAptos();
            selecionarApto(btn)
        };
        btn.addEventListener("click", vOnclick);
        console.log(btn)
    })
}
definirOnclickBtns();

function definirOnclickBtnsScroll() {
    botoesScroll.forEach(btn => {
        var vOnclick = () => {
            getBtnApto(btn).click();
            scrollToFichaTecnica()
        };
        btn.addEventListener("click", vOnclick);
        console.log(btn)
    })
}
definirOnclickBtnsScroll();

function gotoForm() {
    var contato = document.getElementById("contato");
    var yPos = getPosition(contato).y + window.scrollY;
    window.scroll({
        top: yPos,
        behavior: "smooth"
    })
}

function getPosition(el) {
    var xPos = 0;
    var yPos = 0;
    while (el) {
        if (el.tagName == "BODY") {
            var xScroll = el.scrollLeft || document.documentElement.scrollLeft;
            var yScroll = el.scrollTop || document.documentElement.scrollTop;
            xPos += (el.offsetLeft - xScroll + el.clientLeft);
            yPos += (el.offsetTop - yScroll + el.clientTop)
        } else {
            xPos += (el.offsetLeft - el.scrollLeft + el.clientLeft);
            yPos += (el.offsetTop - el.scrollTop + el.clientTop)
        }
        el = el.offsetParent
    }
    return {
        x: xPos,
        y: yPos
    }
}

function getPositionFichaTec() {
    var testeira = document.getElementById("testeita");
    var pushpin = document.getElementById("pushpin");
    var sobre = document.getElementById("sobre");
    return testeira.scrollHeight + pushpin.scrollHeight + sobre.scrollHeight
}

function denifirMascaraTel() {
    var telefones = document.querySelectorAll("input[type='tel']");
    telefones.forEach((telefone) => {
        var phoneMask = new IMask(telefone, {
            mask: '(00) 00000-0000'
        })
    })
}
denifirMascaraTel();

function denifirMascaraData() {
    var datas = document.querySelectorAll(".data");
    datas.forEach((data) => {
        var dateMask = new IMask(data, {
            mask: Date,
            min: new Date(1920, 0, 1),
            max: new Date(2018, 0, 1)
        })
    })
}
denifirMascaraData();

function denifirMascaraCPF() {
    var cpfs = document.querySelectorAll(".cpf");
    cpfs.forEach((cpf) => {
        var dateMask = new IMask(cpf, {
            mask: '000.000.000-00'
        })
    })
}
denifirMascaraCPF();

function denifirMascaraRenda() {
    var rendas = document.querySelectorAll(".renda");
    rendas.forEach((renda) => {
        var dateMask = new IMask(renda, {
            mask: Number
        })
    })
}
denifirMascaraRenda();
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

    function criarJsonEmail() {
        let subject = form.querySelector("input[type=hidden][name='assunto']").value;
        let messageHeader = form.querySelector("input[type=hidden][name='cabecalho']").value;
        let inputs = form.querySelectorAll("input[name]:not([type='hidden']):not([name='terms'])");
        let fields = [];
        inputs.forEach( (input) => {
            fields.push({name: input.name, value: input.value});
        });
        
        inputs = form.querySelectorAll("input[name='modo-contato[]']");
        let contatos = [];
        inputs.forEach( (input) => {
            contatos.push(input.value);
        });

        let horario = form.querySelector("input[name='horario']").value;

        let json = `
            {
                "subject": "${subject}",
                "message-header": "${messageHeader}",
                "fields": {
                    ${fields.map( (field) => {
                        return `"${field.name}": "${field.value}"`
                    }).join(', ')}
                    ,
                    "contato": ${contatos.map( (contato) => {
                        return `"${contato}"`
                    }).join(', ')}
                    ,
                    "horario": "${horario}"
                }
            }
        `;

        return json;
    }

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        
        if (formSubmit()) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    let response = JSON.parse(this.responseText);
                    
                    if ("error" in response) {
                        alert("Erro ao enviar email");
                    }
                    else {
                        alert("Email enviado com sucesso");
                    }
                }
                else if (this.readyState == 4) {
                    alert("Erro ao enviar email");
                }
                
                console.log(this.responseText);
            };

            xhttp.open("POST", "https://patrimoniomanaus.com.br/swiftmailer/sender.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(criarJsonEmail());

            console.log(criarJsonEmail());
        }
    });
})