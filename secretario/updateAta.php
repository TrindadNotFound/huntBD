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

            if(isset($_SESSION['utilizador']))
            {
                $codEvento = $_SESSION['codEvento'];

                $ata = $_POST['ata'];
               
                
                
                if((!empty($ata)))
                {
                    
                    $sql = "UPDATE evento SET ata = '$ata' WHERE codEvento = '$codEvento'";
                    $res = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn)==1)
                    {
                        $_SESSION['title'] = "Sucesso!";
                        $_SESSION['text'] = "Ata atualizada com sucesso";
                        $_SESSION['icon'] = "success"; 
                        $_SESSION['url'] = "../secretario/p_gerirAtas.php";
                    }
                    else
                    {
                        $_SESSION['title'] = "Humm...";
                        $_SESSION['text'] = "Não foram realizadas alterações na ata";
                        $_SESSION['icon'] = "warning"; 
                        $_SESSION['url'] = "../secretario/p_gerirAtas.php";
                    }
                }
                else
                {
                    $_SESSION['title'] = "Ups";
                    $_SESSION['text'] = "A ata deve ser preenchida corretamente";
                    $_SESSION['icon'] = "error"; 
                    $_SESSION['url'] = "../secretario/p_gerirAtas.php";
                }
            }

            include '../include/script.php';
        ?>
    </body>
</html>