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


            if(isset($_FILES['file']))
            {
                $filename = $_FILES['file']['name'];
                $filetmpname = $_FILES['file']['tmp_name'];
                $pasta = '../img_event/';

                $filetype = strtolower(pathinfo($filename,PATHINFO_EXTENSION)); //Capta a extensão do ficheiro

                if ($_FILES['file']['size'] > 6000000) //Compara se o ficheiro tem menos de 6000000 bytes
                {
                    $_SESSION['title'] = "Ups!";
                    $_SESSION['text'] = "Imagem muito grande";
                    $_SESSION['icon'] = "error"; 
                    $_SESSION['url'] = "../events/p_addImagens.php";
                }
                elseif($filetype != 'jpg' && $filetype != 'png' && $filetype != 'jpeg' && $filetype != 'gif') //Compara se a extenão da imagem é diferente das indicadas
                {
                    $_SESSION['title'] = "Ups!";
                    $_SESSION['text'] = "Formato não suportado";
                    $_SESSION['icon'] = "error"; 
                    $_SESSION['url'] = "../events/p_addImagens.php";
                }
                else
                {
                    move_uploaded_file($filetmpname, $pasta.$filename);


                    $codEvento = $_SESSION['codEvento'];

                    $sql ="SELECT MAX(codImagem) AS codImagem FROM imagem";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $codImagem = $row['codImagem'] + 1;
                    echo $codImagem;



                    $nomeUser = $_SESSION['utilizador'];
                    $sql = "SELECT codUtilizador FROM utilizador WHERE nomeUser = '$nomeUser'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $codUtilizador = $row['codUtilizador'];
                    echo $codUtilizador;

                    $ativo = true;


                    $sql = "INSERT INTO imagem (codImagem, codEvento, codUtilizador, imagem, ativo) VALUES ('$codImagem', '$codEvento', '$codUtilizador', '$filename', '$ativo')";
                    $res = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn)==1)
                    {
                        $_SESSION['title'] = "Sucesso";
                        $_SESSION['text'] = "Imagem adicionada com sucesso";
                        $_SESSION['icon'] = "success"; 
                        $_SESSION['url'] = "../events/p_addImagens.php";
                    }
                    else
                    {
                        $_SESSION['title'] = "Ups!";
                        $_SESSION['text'] = "Não foi possivel fazer upload da imagem";
                        $_SESSION['icon'] = "error"; 
                        $_SESSION['url'] = "../events/p_addImagens.php";
                    }
                }
            }
            else
            {
                $_SESSION['title'] = "Ups!";
                $_SESSION['text'] = "Não foi possivel fazer upload da imagem";
                $_SESSION['icon'] = "error"; 
                $_SESSION['url'] = "../events/p_addImagens.php";

            }
            include '../include/script.php';

        ?>

    </body>
</html>