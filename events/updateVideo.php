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
                $pasta = '../video_event/';

                $filetype = strtolower(pathinfo($filename,PATHINFO_EXTENSION)); //Capta a extensão do ficheiro

                if ($_FILES['file']['size'] > 60000000) //Compara se o ficheiro tem menos de 60000000 bytes
                {
                    $_SESSION['title'] = "Ups!";
                    $_SESSION['text'] = "Video muito grande";
                    $_SESSION['icon'] = "error"; 
                    $_SESSION['url'] = "../events/p_addVideo.php";
                }
                elseif($filetype != 'mp4') //Compara se a extenão da imagem é diferente das indicadas
                {
                    $_SESSION['title'] = "Ups!";
                    $_SESSION['text'] = "Formato não suportado";
                    $_SESSION['icon'] = "error"; 
                    $_SESSION['url'] = "../events/p_addVideo.php";
                }
                else
                {
                    move_uploaded_file($filetmpname, $pasta.$filename);


                    $codEvento = $_SESSION['codEvento'];

                    $sql ="SELECT MAX(codVideo) AS codVideo FROM video";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $codVideo = $row['codVideo'] + 1;



                    $nomeUser = $_SESSION['utilizador'];
                    $sql = "SELECT codUtilizador FROM utilizador WHERE nomeUser = '$nomeUser'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $codUtilizador = $row['codUtilizador'];

                    $ativo = true;


                    $sql = "INSERT INTO video (codVideo, codEvento, codUtilizador, video, ativo) VALUES ('$codVideo', '$codEvento', '$codUtilizador', '$filename', '$ativo')";
                    $res = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn)==1)
                    {
                        $_SESSION['title'] = "Sucesso";
                        $_SESSION['text'] = "Video adicionada com sucesso";
                        $_SESSION['icon'] = "success"; 
                        $_SESSION['url'] = "../events/p_addVideo.php";
                    }
                    else
                    {
                        $_SESSION['title'] = "Ups!";
                        $_SESSION['text'] = "Não foi possivel fazer upload do video";
                        $_SESSION['icon'] = "error"; 
                        $_SESSION['url'] = "../events/p_addVideo.php";
                    }
                }
            }
            else
            {
                $_SESSION['title'] = "Ups!";
                $_SESSION['text'] = "Não foi possivel fazer upload do video";
                $_SESSION['icon'] = "error"; 
                $_SESSION['url'] = "../events/p_addVideo.php";

            }

            include '../include/script.php';

        ?>

    </body>
</html>