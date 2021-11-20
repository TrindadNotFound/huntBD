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
            include '../database/basedados.h';
            include '../include/perfil.php';
            

            if(isset($_POST['nomeUser']) && isset($_POST["pw"]))
            {
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

                $nomeUser = $_POST['nomeUser'];
                $pw = md5($_POST['pw']);
                $ativo = 1;

                $codPerfil = SOCIO;

                $sql = "SELECT MAX(codUtilizador) as codUtilizador, MAX(codCarteira) AS codCarteira FROM utilizador";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);

                $codUtilizador = $row['codUtilizador'] + 1;
                $codCarteira = $row['codCarteira'] + 1;

                $sql = "INSERT INTO carteira (codCarteira, saldo, ativo) VALUES ('$codCarteira', 0, '$ativo')";
                $res = mysqli_query($conn, $sql);
            
                $sql = "INSERT INTO utilizador VALUES ('$codUtilizador', '$codPerfil', '$codCarteira', '$nome', '$apelido', '$morada', '$email', '$nif', '$dataNascimento', '$telemovel', '$numPorteArma', '$numApoliceSeguro', '$numLicencaCaca', '$limitacao', '$restricaoAlimentar', '$nomeUser', '$pw', '$ativo')";
                $res = mysqli_query($conn, $sql);

                if(mysqli_affected_rows($conn)==1)
                {


                    $_SESSION['title'] = "Registado com sucesso!";
                    $_SESSION['text'] = "Novo Sócio registado com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../vicePresidente/p_gestSocios.php";
                }
                else
                {
                    $_SESSION['title'] = "Ups...";
                    $_SESSION['text'] = "Não foi possivel registar o novo Sócio";
                    $_SESSION['icon'] = "error"; 
                    $_SESSION['url'] = "../vicePresidente/p_gestSocios.php";
                } 
            }

            include '../include/script.php';
        ?>
    </body>
</html>