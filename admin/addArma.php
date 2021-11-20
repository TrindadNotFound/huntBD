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

            $ativo = true;

            $sql = "SELECT MAX(codArma) AS codArma FROM tipoarma";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($res);

            $codArma = $row['codArma'] + 1;

            $arma = $_POST['arma'];
            $tipotiro = $_POST['tipotiro'];
            if(isset($_POST['silenciador']))
            {
                $silenciador = true;
            }
            else
            {
                $silenciador = false;
            }


            $sql = "INSERT INTO tipoarma (codArma, descricao, especificacaoTiro, silenciador, ativo) VALUES ('$codArma', '$arma', '$tipotiro', '$silenciador', '$ativo')";
            $res = mysqli_query($conn, $sql);

            if(mysqli_affected_rows($conn)==1)
            {
                $_SESSION['title'] = "Sucesso!";
                $_SESSION['text'] = "Nova arma registada";
                $_SESSION['icon'] = "success"; 
                $_SESSION['url'] = "../admin/p_gestArmas.php";
            }
            else
            {
                $_SESSION['title'] = "Ups";
                $_SESSION['text'] = "Não foi possivel registar a nova arma";
                $_SESSION['icon'] = "warning"; 
                $_SESSION['url'] = "../admin/p_gestArmas.php";
            }

            include '../include/script.php';
        ?>
    </body>
</html>