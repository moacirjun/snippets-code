<form method="POST" action="http://<?php echo APP_HOST ?>/vendedor/registrar_cadastro">
    <label for="nome">Nome</label><br>
    <input name="nome" value="<?php echo $viewVar["vendedor"]->get_nome() ?>"><br><br>
    
    <label for="rg">RG</label><br>
    <input name="rg" value="<?php echo $viewVar["vendedor"]->get_rg() ?>"><br><br>
    
    <label for="cpf">CPF</label><br>
    <input name="cpf" value="<?php echo $viewVar["vendedor"]->get_cpf() ?>"><br><br>
    
    <label for="telefone">Telefone</label><br>
    <input name="telefone" value="<?php echo $viewVar["vendedor"]->get_telefone() ?>"><br><br>
    
    <label for="email">email</label><br>
    <input name="email" value="<?php echo $viewVar["vendedor"]->get_email() ?>"><br><br>
    
    <label for="login">login</label><br>
    <input name="login" value="<?php echo $viewVar["vendedor"]->get_login() ?>"><br><br>
    
    <label for="senha">Senha</label><br>
    <input name="senha" value="<?php echo $viewVar["vendedor"]->get_senha() ?>"><br><br>
    
    <label for="tipo">tipo</label><br>
    <input name="tipo" value="<?php echo $viewVar["vendedor"]->get_tipo() ?>"><br><br>
    
    <input type="submit" value="Cadastrar">
</form>