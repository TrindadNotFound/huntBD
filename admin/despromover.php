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




                if($row['codPerfil'] == PRESIDENTE) //Se for UTENTE passa para UTENTE_NAO_VALIDO
                {
                    $codPerfil = VICE_PRESIDENTE;
                    $sql = "UPDATE utilizador SET codPerfil='$codPerfil' WHERE nomeUser='$nomeUser'";
                    $res = mysqli_query($conn, $sql);




                    $sql = "SELECT codUtilizador FROM utilizador WHERE nomeUSer = '$nomeUser'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $codUtilizador = $row['codUtilizador'];

                    $sql = "SELECT MAX(codPresidente) AS codPresidente FROM utilizadopresidente";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

                    if($row['codPresidente'] === NULL)
                    {
                        $codPresidente = 1;
                    }
                    else
                    {
                        $codPresidente = $row['codPresidente'] + 1;
                    }

                    date:date_default_timezone_set('GMT');
                    $dataSistema = date('Y-m-d');
                    $ativo = true;

                    $sql = "SELECT MAX(codPresidente) AS codPresidente FROM utilizadopresidente";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $codPresidente = $row['codPresidente'];


                    $sql = "UPDATE utilizadopresidente SET dataFim = '$dataSistema' WHERE codPresidente = '$codPresidente'";
                    $res = mysqli_query($conn, $sql);






                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Utilizador despromovido com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestUtilizadores.php"; 
                           
                }

                elseif($row['codPerfil'] == VICE_PRESIDENTE) //Se for UTENTE_NAO_VALIDO passa para UTENTE_ELIMINADO
                {
                    $codPerfil = SECRETARIO;
                    $sql = "UPDATE utilizador SET codPerfil='$codPerfil' WHERE nomeUser='$nomeUser'";
                    $res = mysqli_query($conn, $sql);

                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Utilizador despromovido com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestUtilizadores.php";          
                }

                elseif($row['codPerfil'] == SECRETARIO) //Se for UTENTE_ELIMINADO passa para UTENTE_NAO_VALIDO
                {
                    $codPerfil = SOCIO;
                    $sql = "UPDATE utilizador SET codPerfil='$codPerfil' WHERE nomeUser='$nomeUser'";
                    $res = mysqli_query($conn, $sql);
  
                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Utilizador despromovido com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestUtilizadores.php";
                }

                elseif($row['codPerfil'] == SOCIO) //Se for UTENTE_ELIMINADO passa para UTENTE_NAO_VALIDO
                {
                    $codPerfil = POR_VALIDAR;
                    $sql = "UPDATE utilizador SET codPerfil='$codPerfil' WHERE nomeUser='$nomeUser'";
                    $res = mysqli_query($conn, $sql);
  
                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Utilizador despromovido com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestUtilizadores.php";
                }

                elseif($row['codPerfil'] == POR_VALIDAR) //Se for UTENTE_ELIMINADO passa para UTENTE_NAO_VALIDO
                {
                    $codPerfil = DESATIVADO;
                    $sql = "UPDATE utilizador SET codPerfil='$codPerfil' WHERE nomeUser='$nomeUser'";
                    $res = mysqli_query($conn, $sql);
  
                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Utilizador desativado com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestUtilizadores.php";
                }
            }
            include '../include/script.php';     

        ?>
    </body>
</html>