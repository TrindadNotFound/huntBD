<?php
    session_start();
    unset($_SESSION['title']);
    unset($_SESSION['texto']);
    unset($_SESSION['icon']);
    unset($_SESSION['url']);
    unset($_SESSION['divida']);

    header('refresh:0; p_consultarQuotas.php');
?>