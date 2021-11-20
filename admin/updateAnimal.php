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
                $codAnimal = $_SESSION['codAnimal'];

                $animal = $_POST['animal'];
               
                
                
                if((!empty($animal)))
                {
                    
                    $sql = "UPDATE tipoanimal SET especie = '$animal' WHERE codAnimal = '$codAnimal'";
                    $res = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn)==1)
                    {
                        $_SESSION['title'] = "Sucesso!";
                        $_SESSION['text'] = "Dados alterados com sucesso";
                        $_SESSION['icon'] = "success"; 
                        $_SESSION['url'] = "../admin/p_gestAnimais.php";
                    }
                    else
                    {
                        $_SESSION['title'] = "Humm...";
                        $_SESSION['text'] = "Não foram realizadas alterações nos dados";
                        $_SESSION['icon'] = "warning"; 
                        $_SESSION['url'] = "../admin/p_gestAnimais.php";
                    }
                }
                else
                {
                    $_SESSION['title'] = "Ups";
                    $_SESSION['text'] = "Os campos devem ser preenchidos corretamente";
                    $_SESSION['icon'] = "error"; 
                    $_SESSION['url'] = "../admin/p_gestAnimais.php";
                }
            }

            include '../include/script.php';
        ?>
    </body>
</html>