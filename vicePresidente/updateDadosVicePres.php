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

        $codUtilizador = $_SESSION['codUtilizador'];

        if(isset($_SESSION['utilizador']))
        {
            $nomeUser = $_POST['nomeUser'];

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


            if((!empty($_POST['pw'])))
            {
                $pw = $_POST['pw'];

            
                if((isset($pw)))
                {
                    $password = md5($pw);
                    $sql = "UPDATE utilizador SET nome='$nome', apelido='$apelido', morada='$morada', email='$email', nif='$nif', dataNascimento='$dataNascimento', telemovel='$telemovel', numPorteArma='$numPorteArma', numApoliceSeguro='$numApoliceSeguro', numLicencaCaca='$numLicencaCaca', limitacao='$limitacao', restricaoAlimentar='$restricaoAlimentar', nomeUser='$nomeUser', password='$password' WHERE codUtilizador='$codUtilizador'";       
                    $res= mysqli_query($conn, $sql);
                }
                else
                {
                    $sql = "SELECT password FROM utilizador WHERE codUtilizador='$codUtilizador'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $pw = $row['password'];
                    
                    $sql2 = "UPDATE utilizador SET nome='$nome', apelido='$apelido', morada='$morada', email='$email', nif='$nif', dataNascimento='$dataNascimento', telemovel='$telemovel', numPorteArma='$numPorteArma', numApoliceSeguro='$numApoliceSeguro', numLicencaCaca='$numLicencaCaca', limitacao='$limitacao', restricaoAlimentar='$restricaoAlimentar', nomeUser='$nomeUser', password='$pw' WHERE codUtilizador='$codUtilizador'";       
                    $res2 = mysqli_query($conn, $sql2); 
                }   
            }
            else
            {
                $sql = "SELECT password FROM utilizador WHERE codUtilizador='$codUtilizador'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
                $pw = $row['password'];
                
                $sql2 = "UPDATE utilizador SET nome='$nome', apelido='$apelido', morada='$morada', email='$email', nif='$nif', dataNascimento='$dataNascimento', telemovel='$telemovel', numPorteArma='$numPorteArma', numApoliceSeguro='$numApoliceSeguro', numLicencaCaca='$numLicencaCaca', limitacao='$limitacao', restricaoAlimentar='$restricaoAlimentar', nomeUser='$nomeUser', password='$pw' WHERE codUtilizador='$codUtilizador'";       
                $res2 = mysqli_query($conn, $sql2); 
            }
            
            
            if(mysqli_affected_rows($conn)==1)
            {
                $_SESSION['title'] = "Sucesso!";
                $_SESSION['text'] = "Dados alterados com sucesso";
                $_SESSION['icon'] = "success"; 
                $_SESSION['url'] = "../vicePresidente/p_gestSocios.php";
            }
            else
            {
                $_SESSION['title'] = "Humm...";
                $_SESSION['text'] = "Não foram realizadas alterações nos dados";
                $_SESSION['icon'] = "warning"; 
                $_SESSION['url'] = "../vicePresidente/p_gestSocios.php";
            }
                
        }

        include '../include/script.php';
        
    ?>
</body>
</html>