let dados = {
    nomeCliente: "Moacir",
    contatoCliente: "(92) 98243-8992",
    amigos: [
        {
            nome: "Emiliandro",
            telefone: "(92) 99999-9999"
        },
        {
            nome: "Emiliandro",
            telefone: "(92) 99999-9999"
        },
        {
            nome: "Emiliandro",
            telefone: "(92) 99999-9999"
        },
    ]
};

let corpoReq = {
    subject: "Teste",
    message_header: "Outro teste",
    fields : dados
};

function enviar() {
    let ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status === 200) {
                alert("Enviado com sucesso!");
            }
            else if (this.status === 400) {
                alert("Erro. Consulte seus dados enviados e tente novamente");
            }
            else {
                alert("Erro");
            }
            console.log(this.responseText);
        }
        console.log(this.responseText);
    };
    ajax.open("POST", "https://patrimoniomanaus.com.br/swiftmailer/sender.php", true);
    ajax.setRequestHeader("Content-type", "application/json");
    ajax.send(JSON.stringify(corpoReq));
}