<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <title>Associação de Caça</title>
    </head>
    <body>
        <?php
            session_start();
            include '../database/basedados.h';

            $ativo = true;


            $codtipo = $_GET['evento'];
            $codarma = $_GET['arma'];


            $sql = "INSERT INTO armaevento (codTipo, codArma, ativo) VALUES ('$codtipo', '$codarma', '$ativo')";
            $res = mysqli_query($conn, $sql);

            if(mysqli_affected_rows($conn)==1)
            {
                $_SESSION['title'] = "Sucesso!";
                $_SESSION['text'] = "Novo tipo de evento registado com sucesso";
                $_SESSION['icon'] = "success"; 
                $_SESSION['url'] = "../admin/p_gestTipoEventos.php";
            }
            else
            {
                $_SESSION['title'] = "Ups";
                $_SESSION['text'] = "Não foi possivel o novo tipo de evento";
                $_SESSION['icon'] = "warning"; 
                $_SESSION['url'] = "../admin/p_gestTipoEventos.php";
            }

            include '../include/script.php';
        ?>
    </body>
</html>