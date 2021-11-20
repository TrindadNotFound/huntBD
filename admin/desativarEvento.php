<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <title>Associação Caça</title>
    </head>
    <body>
        <?php
            session_start();
            include '../database/basedados.h';
            include '../include/perfil.php';

            if(isset($_SESSION['utilizador']))
            {
                $codEvento = $_GET['codEvento'];
                $ativo=false;

                $sql = "UPDATE evento SET ativo='$ativo' WHERE codEvento = '$codEvento'";
                $res = mysqli_query($conn, $sql);

                if(mysqli_affected_rows($conn)==1)
                {
                    $_SESSION['title'] = "Sucesso!";
                    $_SESSION['text'] = "Evento desativado com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestEventos.php";
                }
                else
                {
                    $_SESSION['title'] = "Ups";
                    $_SESSION['text'] = "Não foi possivel desativar o evento selecionado ";
                    $_SESSION['icon'] = "warning"; 
                    $_SESSION['url'] = "../admin/p_gestEventos.php";
                }

                include '../include/script.php';
            }  
        ?>
    </body>
</html>