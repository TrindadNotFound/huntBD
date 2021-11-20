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


            $nomeUser = $_GET['nomeUser'];
            $codPerfil=SOCIO;

            $sql = "SELECT codUtilizador FROM utilizador WHERE nomeUser = '$nomeUser'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($res);
            $codUtilizador = $row['codUtilizador'];


            $sql = "UPDATE utilizador SET codPerfil='$codPerfil' WHERE nomeUser='$nomeUser'"; //Quando o utilizador é validado,é feito o UPDATE ao seu tipo de perfil
            $res = mysqli_query($conn, $sql);
    

            if(mysqli_affected_rows($conn)==1)  //Depois do tipoPerfil ser atualizado, é feita a verificação se este utilizador ja tem quotas para pagar
            {
                $sql = "SELECT codUtilizador FROM quota";
                $res = mysqli_query($conn, $sql);
                $x = 0;

                while($row = mysqli_fetch_array($res))
                {
                    if($row['codUtilizador'] == $codUtilizador) //Varifica quantoas vezes aparece o codUtilizador do utilizador que foi validado
                    {
                        $x = $x + 1;
                    }
                }

                if($x == 0) //Se nao aparecer vez enhuma ($x == 0) entao é criada uma nova quota para pagar
                {
                    $ativo = true;

                    //Depois do utilizador ser validado, é criado uma quota para pagamento
                    $sql = "SELECT MAX(codQuota) AS codQuota FROM quota";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $codQuota = $row['codQuota'] + 1;


                    date:date_default_timezone_set('GMT');
                    $lastDateNextMonth =strtotime('last day of next month') ; //Ultimo dia no mês seguinte ao atual
                    $lastDay = date('Y-m-d', $lastDateNextMonth);

                    $sql = "INSERT INTO quota (codQuota, codUtilizador, tipoQuota, dataVencimento, estado, ativo) VALUES ('$codQuota', '$codUtilizador', 1, '$lastDay', 0, '$ativo')";
                    $res = mysqli_query($conn, $sql); 
                }

                $_SESSION['title'] = "Sucesso";
                $_SESSION['text'] = "Utilizador validade com sucesso";
                $_SESSION['icon'] = "success"; 
                $_SESSION['url'] = "../admin/p_gestUtilizadores.php";
        
            }
            else
            {
                $_SESSION['title'] = "Ups";
                $_SESSION['text'] = "Não foi possivel validar este perfil de utilizador";
                $_SESSION['icon'] = "error"; 
                $_SESSION['url'] = "../admin/p_gestUtilizadores.php";            
            }

            //Faz include do ficheiro "script.php" onde consta as funções JS
            include '../include/script.php';
        ?>
    </body>
</html>