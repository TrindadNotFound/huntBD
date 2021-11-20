<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <title>Document</title>
    </head>
    <body>
        <?php
            session_start();

            include '../database/basedados.h';
            include '../include/perfil.php';

            if(isset($_SESSION['utilizador']))
            {
                $nomeUser = $_GET['nomeUser'];

                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser='$nomeUser'";
                $res = mysqli_query($conn, $sql);

                $row = mysqli_fetch_array($res);




                if($row['codPerfil'] == SOCIO) //Se for UTENTE passa para UTENTE_NAO_VALIDO
                {
                    $codPerfil = POR_VALIDAR;
                    $sql = "UPDATE utilizador SET codPerfil='$codPerfil' WHERE nomeUser='$nomeUser'";
                    $res = mysqli_query($conn, $sql);

                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Utilizador despromovido com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestUtilizadores.php";          
                }

                elseif($row['codPerfil'] == POR_VALIDAR) //Se for UTENTE_NAO_VALIDO passa para UTENTE_ELIMINADO
                {
                    $codPerfil = DESATIVADO;
                    $sql = "UPDATE utilizador SET codPerfil='$codPerfil' WHERE nomeUser='$nomeUser'";
                    $res = mysqli_query($conn, $sql);

                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Utilizador despromovido com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestUtilizadores.php";          
                }

                elseif($row['codPerfil'] == DESATIVADO) //Se for UTENTE_ELIMINADO passa para UTENTE_NAO_VALIDO
                {
                    $codPerfil = POR_VALIDAR;
                    $sql = "UPDATE utilizador SET codPerfil='$codPerfil' WHERE nomeUser='$nomeUser'";
                    $res = mysqli_query($conn, $sql);
  
                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Utilizador promovido com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestUtilizadores.php";
                }
            }
            include '../include/script.php';     

        ?>
    </body>
</html>