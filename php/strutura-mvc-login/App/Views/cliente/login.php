<h1>LOGIN</h1>

<form class="form" method="POST" action="http://<?php echo APP_HOST ?>/cliente/autenticar">
        
    <?php if ($sessao::retornaErro()) : foreach($sessao::retornaErro() as $key => $mensagem) : ?>
        <div class="container-msgs-erro">
            <?php echo $mensagem ?>
        </div>
    <?php endforeach; endif; ?>

    <label> NOME DE USUÁRIO / E-MAIL </label>
    <input type="email" name="email">

    <label> SENHA </label>
    <input type="password" name="senha">

    <input type="submit" value="ACESSAR">
</form>