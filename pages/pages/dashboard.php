<?php

switch ($_SESSION['NIVEL']) {
    case 0:
        include_once 'dashboards/_root.php';
        break;
    case 1:
        include_once 'dashboards/_adm.php';
        break;
    case 2:
        include_once 'dash/dashAtentente.php';
        break;
    case 3:
        include_once 'dash/dashMedico.php';
        break;

    default;
        include "./pages/404.php";
        break;
}