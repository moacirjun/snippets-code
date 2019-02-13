<h1>CADASTRAR JOVEM</h1>

<form class="form" method="POST" action="http://<?php echo APP_HOST ?>/cliente/registrar_cadastro">

    <?php if ($sessao::retornaErro()) : foreach($sessao::retornaErro() as $key => $mensagem) : ?>
        <div class="container-msgs-erro">
            <?php echo $mensagem ?>
        </div>
    <?php endforeach; endif; ?>

    <label> NOME </label>
    <input type="text" name="nome">

    <label> RG </label>
    <input type="text" name="rg">

    <label> CPF </label>
    <input type="number" name="cpf">

    <label> TELEFONE </label>
    <input type="tel" name="telefone">

    <label> E-MAIL </label>
    <input type="" name="email">

    <label> SENHA </label>
    <input type="password" name="senha">

    <input type="submit" value="CADASTRAR">

</form>