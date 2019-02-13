<form method="POST" action="http://<?php echo APP_HOST ?>/vendedor/registrar_exclusao">
    <h1>Você realmente deseja apagar o usuário <?php echo $viewVar["vendedor"]->get_nome() ?>?</h1>
    <a href="http://<?php echo APP_HOST ?>/vendedor/listar">Cancelar</a>
    
    <input type="hidden" name="id" value="<?php echo $viewVar["vendedor"]->get_id() ?>">
    <input type="submit" value="Excluir">    
</form>

