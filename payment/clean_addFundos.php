<?php
    session_start();
    unset($_SESSION['title']);
    unset($_SESSION['texto']);
    unset($_SESSION['icon']);
    unset($_SESSION['url']);

    header('refresh:0; p_fundos.php');
?>