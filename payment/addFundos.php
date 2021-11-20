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

        $nomeUser = $_SESSION['utilizador'];
        $montante = $_POST['montante']; //Valor que o utilizador escolheu adicionar na página "p_fundos.php"


        //Seleciona o codCarteira do utilizador que esta a utilizar a plataforma
        $sql = "SELECT codCarteira FROM utilizador WHERE nomeUser = '$nomeUser'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $codCarteira = $row['codCarteira']; //Aqui esta o codigo do utilizador


        //
        $sql = "SELECT saldo FROM carteira WHERE codCarteira = '$codCarteira'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $saldoExistente = $row['saldo'];



        $saldoAtualizado = $saldoExistente + $montante;

        $sql = "UPDATE carteira SET saldo = '$saldoAtualizado' WHERE codCarteira = '$codCarteira'";
        $res = mysqli_query($conn, $sql);



        $_SESSION['title'] = "Fundos adicionados com sucesso";
        $_SESSION['text'] = "Pode consultar a sua carteira digital para saber o seu saldo atual";
        $_SESSION['icon'] = "success"; 
        $_SESSION['url'] = "../payment/clean_addFundos.php";

        //Faz include do ficheiro "script.php" onde consta as funções JS
        include '../include/script.php';
    ?>

</body>
</html>