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
                $codEvento = $_GET['codEvento'];
                $ativo = true;

                $sql = "SELECT codUtilizador FROM utilizador WHERE nomeUser = '$nomeUser'"; //Procurar codUtilizador
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
                $codUtilizador = $row['codUtilizador'];

                

                $sql = "SELECT c.saldo, c.codCarteira FROM carteira AS c INNER JOIN utilizador AS u ON (c.codCarteira = u.codCarteira) WHERE u.codUtilizador = '$codUtilizador'"; //Procurar saldo da conta
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
                $saldo = $row['saldo'];
                $codCarteira = $row['codCarteira']; //Saber o codCarteira do utilizador para poder preencher a tabela TRASACAO



                $sql = "SELECT preco, vaga FROM evento WHERE codEvento = '$codEvento'"; //Procura o valor do evento
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
                $preco = $row['preco'];
                $vaga = $row['vaga'];
                
                
                if($saldo >= $preco) //Se o saldo disponivel na conta for suficiente para pagar o evento...
                {   
                    $codConta = 1; // 1 diz respeito à conta dos Eventos
                    $ativo = true;

                    date:date_default_timezone_set('GMT'); //DATA DO DIA EM QUE É FEITA A INSCRICAO NO EVENTO
                    $dataSistema = date('Y-m-d');

                    //Obtem o maior CODTRANSACAO da tabela TRANSACAO
                    $sql = "SELECT MAX(codTransacao) AS codTransacao FROM transacao";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

                    if($row['codTransacao'] === NULL)
                    {
                        $codTransacao = 1;
                    }
                    else
                    {
                        $codTransacao = $row['codTransacao'] + 1;
                    }

                    $sql = "INSERT INTO transacao (codTransacao, codConta, codCarteira, valor, data, ativo) VALUES ('$codTransacao', '$codConta', '$codCarteira', '$preco', '$dataSistema', '$ativo')";
                    $res = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn)==1)
                    {
                        $sql = "SELECT saldo FROM tesouraria WHERE codConta = '$codConta'";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);

                        $tesouraria = $row['saldo'] + $preco;

                        $sql = "UPDATE tesouraria SET saldo = '$tesouraria' WHERE codConta = '$codConta'";
                        $res = mysqli_query($conn, $sql);
                    }

            


                    $sql = "SELECT vaga FROM evento WHERE codEvento = '$codEvento'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $vagas_existentes = $row['vaga'];

                    $sql = "SELECT porta FROM portaevento WHERE codEvento = '$codEvento'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

                    
                    if(mysqli_affected_rows($conn)==1)
                    {   
                        $x = 1;
                        while($x != 0)
                        {   
                            $colocacao = rand(1, $vagas_existentes);
                            for($i = 1; $i<= $row['porta']; $i++)
                            {
                                if($colocacao !== $row['porta'])
                                {
                                    $x = 0;
                                }
                            }
                            
                        }

                        $sql = "SELECT MAX(codColocacao) AS codColocacao FROM portaevento";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);

                        if($row['codColocacao'] == NULL)
                        {
                            $codColocacao = 1;
                        }
                        elseif($row['codColocacao'] != 0)
                        {
                            $codColocacao = $row['codColocacao'];
                            $codColocacao = $codColocacao + 1;
                        }

                        $sql = "INSERT INTO portaevento (codColocacao, codEvento, codUtilizador, porta, ativo) VALUES ('$codColocacao', '$codEvento', '$codUtilizador', '$colocacao', '$ativo')";
                        $res = mysqli_query($conn, $sql);
                        
                    }
                    else
                    {
                        $colocacao = rand(1, $vagas_existentes);

                        $sql = "SELECT MAX(codColocacao) AS codColocacao FROM portaevento";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);

                        if($row['codColocacao'] == NULL)
                        {
                            $codColocacao = 1;
                        }
                        elseif($row['codColocacao'] != 0)
                        {
                            $codColocacao = $row['codColocacao'];
                            $codColocacao = $codColocacao + 1;
                        }

                        $sql = "INSERT INTO portaevento (codColocacao, codEvento, codUtilizador, porta, ativo) VALUES ('$codColocacao', '$codEvento', '$codUtilizador', '$colocacao', '$ativo')";
                        $res = mysqli_query($conn, $sql);
                    }

                    $sql = "INSERT INTO eventoutilizador(codEvento, codUtilizador, ativo) VALUES ('$codEvento', '$codUtilizador', '$ativo')";
                    $res = mysqli_query($conn, $sql);

                    if(mysqli_affected_rows($conn)==1)
                    {
                        $sql = "SELECT vagaatual FROM evento WHERE codEvento = '$codEvento'";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);

                        $updateVaga = $row['vagaatual'] - 1;
                        $sql = "UPDATE evento SET vagaatual = '$updateVaga' WHERE codEvento = '$codEvento'";
                        $res = mysqli_query($conn, $sql);

                        $sql = "SELECT saldo FROM carteira WHERE codCarteira = '$codCarteira'";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);

                        $update_saldo = $row['saldo'] - $preco;

                        $sql = "UPDATE carteira SET saldo = '$update_saldo' WHERE codCarteira = '$codCarteira'";
                        $res = mysqli_query($conn, $sql);
                        

                        
                        $_SESSION['title'] = "Obrigado!";
                        $_SESSION['text'] = "Foi inscrino no evento com sucesso";
                        $_SESSION['icon'] = "success"; 
                        $_SESSION['url'] = "../events/p_calendarioEventos.php";
                    }
                    else
                    {
                        $_SESSION['title'] = "Ups!";
                        $_SESSION['text'] = "Não foi possivel realizar a inscrição no evento";
                        $_SESSION['icon'] = "error"; 
                        $_SESSION['url'] = "../events/p_calendarioEventos.php";
                    }
                }
                else
                {
                    $_SESSION['title'] = "Ups!";
                    $_SESSION['text'] = "O seu saldo é insuficiente";
                    $_SESSION['icon'] = "error"; 
                    $_SESSION['url'] = "../events/p_calendarioEventos.php";
                }
            }
            else
            {
                session_destroy();
                header("refresh:0; ../index.php");
            }

            include '../include/script.php';

        ?>
    </body>
</html>