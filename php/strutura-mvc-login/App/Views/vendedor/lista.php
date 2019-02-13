<a href="http://<?php echo APP_HOST ?>/vendedor/cadastrar">Adicionar</a>
<table>
    <thead>
        <tr>
            <td>Nome</td>
            <td>Login</td>
            <td>Email</td>
            <td>tipo</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($viewVar["vendedores"] as $usuario) : ?>
        <tr>
            <td><?php echo $usuario->get_nome() ?></td>
            <td><?php echo $usuario->get_login() ?></td>
            <td><?php echo $usuario->get_email() ?></td>
            <td><?php echo $usuario->get_tipo() ?></td>
            <td>
                <a href="http://<?php echo APP_HOST ?>/vendedor/editar/<?php echo $usuario->get_id() ?>">Editar</a>
                <span> - </span>
                <a href="http://<?php echo APP_HOST ?>/vendedor/excluir/<?php echo $usuario->get_id() ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
