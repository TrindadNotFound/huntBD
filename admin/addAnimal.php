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

            $sql = "SELECT MAX(codAnimal) AS codAnimal FROM tipoanimal";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($res);

            $codAnimal = $row['codAnimal'] + 1;

            $animal = $_POST['animal'];
     
            $sql = "INSERT INTO tipoanimal (CodAnimal, especie, ativo) VALUES ('$codAnimal', '$animal', '$ativo')";
            $res = mysqli_query($conn, $sql);

            if(mysqli_affected_rows($conn)==1)
            {
                $_SESSION['title'] = "Sucesso!";
                $_SESSION['text'] = "Nova especie animal registada com sucesso";
                $_SESSION['icon'] = "success"; 
                $_SESSION['url'] = "../admin/p_gestAnimais.php";
            }
            else
            {
                $_SESSION['title'] = "Ups";
                $_SESSION['text'] = "Não foi possivel registar a nova especie animal";
                $_SESSION['icon'] = "warning"; 
                $_SESSION['url'] = "../admin/p_gestAnimais.php";
            }

            include '../include/script.php';
        ?>
    </body>
</html>