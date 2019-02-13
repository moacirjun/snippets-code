<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form builder</title>
</head>
<body>
    <section id="contato">
        <div class="container">
            <div class="two columns">
                <h3>APROVEITE O MENOR PREÇO DO ANO!</h3>
            </div>
            <div class="six columns">
                <form method="post" action="">
                    <!-- <h3>CADASTRE-SE E CONHEÇA NOSSOS PRODUTOS E VANTAGENS</h3>
                    <label>Preencha com seus dados</label>
                    <input type="text" name="nome" placeholder="Nome Completo" required>
                    <input type="text" name="data_nasc" class="data" placeholder="Data de Nascimento" required>
                    <input type="text" name="endereco" placeholder="Endereço" required>
                    <input type="text" name="renda" class="renda" placeholder="Renda Familiar" required>
                    <input type="tel" name="telefone" placeholder="Telefone" required>
                    <input type="text" name="cpf" class="cpf" placeholder="CPF" required>
                    <input type="email" name="email" placeholder="E-MAIL" required> -->

                    <?php
                        require_once "functions.php";
                    
                    ?>
                    
                    <?php require("contato-horario-modo.php"); ?>
                    
                    <?php if (isset($_GET["enviado"]) && $_GET["enviado"] == "true") : ?>
                        <input class="botao" type="submit" value="ENVIADO COM SUCESSO!" disabled style="background-color:#85bc71">
                    <?php else : ?>
                        <input class="botao" type="submit" value="Enviar">
                    <?php endif ?>
                    <?php if (isset($_GET["origin"]) && !empty($_GET["origin"]) ) : ?>
                        <input type="hidden" value="<?php echo $_GET["origin"] ?>" name="Origem">
                    <?php else : ?>
                        <input type="hidden" value="Orgânico" name="Origem">
                    <?php endif ?>
                    <input type="hidden" value="Um potencial cliente acaba de submeter seus dados na Landing Page do Smile" name="cabecalho">
                    <input type="hidden" value="Novo Cadastro na Landing Page do Smile - LBZ Agency" name="assunto">
                    <input type="hidden" value="contato" name="container-id">
                </form>
            </div>
        </div>
    </section>
    
    <link rel="stylesheet" href="assets/css/main.css">
    <script type="text/javascript" src="assets/js/mask.js"></script>
    <script type="text/javascript" async src="assets/js/main.js"></script>
</body>
</html>
