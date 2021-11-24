<?php

require_once './../../../data/dbasys.php';
require_once './../../../data/outfunc.php';
$idP = $_POST['idEdit'];


if (isset($_POST['gravar']) && $_POST['gravar'] == 'gravar') {
    $usuario['passUser'] = strip_tags(strip_tags(trim(md5($_POST['passUser']))));

    $updateU = atualizar('users', $usuario, "id = '{$_POST['idEdit']}'");

    echo "<script type='text/javascript'>
        alert('Senha do Usuario foi alterda com sucesso !');
        window.location = '../../../inicio.php?page=listarusuarios';
    </script>";
}
