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
                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
    
                
                if($row['codPerfil'] = ADMIN)
                {
                    $sql = "SELECT MAX(codLocalizacao) AS codLocalizacao FROM localizacao";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

                    $codLocalizacao = $row['codLocalizacao'] + 1;
                    $morada = $_POST['morada'];
                    $mancha = $_POST['mancha'];
                    $ativo = true;


                    $sql = "INSERT INTO localizacao (codLocalizacao, morada, mancha, ativo) VALUES ('$codLocalizacao', '$morada', '$mancha', '$ativo')";
                    $res = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn)==1)
                    {
                        $_SESSION['title'] = "Sucesso!";
                        $_SESSION['text'] = "A nova localização foi registada com sucesso";
                        $_SESSION['icon'] = "success"; 
                        $_SESSION['url'] = "../admin/p_addLocalizacao.php";
                    }
                    else
                    {
                        $_SESSION['title'] = "Ups";
                        $_SESSION['text'] = "Não foi possivel registar a nova localização";
                        $_SESSION['icon'] = "warning"; 
                        $_SESSION['url'] = "../admin/p_addLocalizacao.php";
                    }

                }
            }

            include '../include/script.php';     

        ?>
    </body>
</html>