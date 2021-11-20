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
                $nomeUser = $_SESSION['utilizador'];

                $nome = $_POST['nome'];
                $apelido = $_POST['apelido'];
                $dataNascimento = $_POST['dataNascimento'];

                $morada = $_POST['morada'];
                $telemovel = $_POST['telemovel'];
                $email = $_POST['email'];

                $nif = $_POST['nif'];
                $limitacao = $_POST['limitacao'];
                $restricaoAlimentar = $_POST['restricaoAlimentar'];

                $numPorteArma = $_POST['numPorteArma'];
                $numApoliceSeguro = $_POST['numApoliceSeguro'];
                $numLicencaCaca = $_POST['numLicencaCaca'];


                if((!empty($_POST['pw'])) && (!empty($_POST['pw2'])))
                {
                    $pw = $_POST['pw'];
                    $pw2 = $_POST['pw2'];

                
                    if((isset($pw) && isset($pw2)) && ($pw==$pw2))
                    {
                        $password = md5($pw2);
                        $sql = "UPDATE utilizador SET nome='$nome', apelido='$apelido', morada='$morada', email='$email', nif='$nif', dataNascimento='$dataNascimento', telemovel='$telemovel', numPorteArma='$numPorteArma', numApoliceSeguro='$numApoliceSeguro', numLicencaCaca='$numLicencaCaca', limitacao='$limitacao', restricaoAlimentar='$restricaoAlimentar', password='$password' WHERE nomeUser='$nomeUser'";       
                        $res= mysqli_query($conn, $sql);
                    }
                    else
                    {
                        $sql = "SELECT password FROM utilizador WHERE nomeUser='$nomeUser'";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);
                        $pw = $row['password'];
                        
                        $sql2 = "UPDATE utilizador SET nome='$nome', apelido='$apelido', morada='$morada', email='$email', nif='$nif', dataNascimento='$dataNascimento', telemovel='$telemovel', numPorteArma='$numPorteArma', numApoliceSeguro='$numApoliceSeguro', numLicencaCaca='$numLicencaCaca', limitacao='$limitacao', restricaoAlimentar='$restricaoAlimentar', password='$pw' WHERE nomeUser='$nomeUser'";       
                        $res2 = mysqli_query($conn, $sql2); 
                    }   
                }
                else
                {
                    $sql = "SELECT password FROM utilizador WHERE nomeUser='$nomeUser'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $pw = $row['password'];
                    
                    $sql2 = "UPDATE utilizador SET nome='$nome', apelido='$apelido', morada='$morada', email='$email', nif='$nif', dataNascimento='$dataNascimento', telemovel='$telemovel', numPorteArma='$numPorteArma', numApoliceSeguro='$numApoliceSeguro', numLicencaCaca='$numLicencaCaca', limitacao='$limitacao', restricaoAlimentar='$restricaoAlimentar', password='$pw' WHERE nomeUser='$nomeUser'";       
                    $res2 = mysqli_query($conn, $sql2); 
                }
                
                
                if(mysqli_affected_rows($conn)==1)
                {
                    $_SESSION['title'] = "Obrigado!";
                    $_SESSION['text'] = "O seu registo no evento foi feito com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../index.php";
                }
                else
                {
                    $_SESSION['title'] = "Humm...";
                    $_SESSION['text'] = "Não foram feitas alterações";
                    $_SESSION['icon'] = "warning"; 
                    $_SESSION['url'] = "../index.php";
                }
                
            }

            include '../include/script.php';
        ?>
    </body>
</html>