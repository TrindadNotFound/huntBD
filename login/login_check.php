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

            date:date_default_timezone_set('GMT');
            $dataSistema = date('Y-m-d');

            $ativo = true;

            if(!isset($_SESSION["utilizador"]) || !isset($_SESSION["perfil"])) //Se as variaveis de sessão $_SESSION["utilizador"] ou $_SESSION["perfil"] não estao criadas
            {
                $_SESSION['title'] = "Ups";
                $_SESSION['text'] = "Alguma coisa correu mal. Não foi possivel efetuar o login";
                $_SESSION['icon'] = "warning";
                $_SESSION['url'] = "../login/p_login.php";
                session_destroy();
            }
            else
            {
                if($_SESSION["perfil"] == POR_VALIDAR) //Verifica se o perfil foi igual ao UTENTE_NAO_VALIDO
                {
                    $_SESSION['title'] = "Estamos quase";
                    $_SESSION['text'] = "A sua conta está a ser verificada pelos nossos serviços";
                    $_SESSION['icon'] = "info";
                    $_SESSION['url'] = "../login/p_login.php";
                    session_destroy();
                }
                else if($_SESSION["utilizador"] == -1 || $_SESSION["perfil"] == -1) //Verifica se o conteudo das variaveis de sessão é igual a -1
                {
                    $_SESSION['title'] = "Ups";
                    $_SESSION['text'] = "Não foi possivel efetuar o login com sucesso";
                    $_SESSION['icon'] = "warning";
                    $_SESSION['url'] = "../login/p_login.php";
                    session_destroy();
                }
                else //Caso a validação seja bem feita
                {


                    //date:date_default_timezone_set('GMT');
                    //$dataSistema = date('Y-m-d'); //Guarda a data do sistema para poder comprar com a data de vencimento
                    $nomeUser = $_SESSION['utilizador'];

                    $sql = "SELECT codUtilizador FROM utilizador WHERE nomeUser = '$nomeUser'"; //PARA SABER O codUtilizador CORRESPONDENTE AO nomeUser
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $codUtilizador = $row['codUtilizador'];
                    

                    $sql = "SELECT dataVencimento, estado FROM quota WHERE codUtilizador = '$codUtilizador' AND estado != 1 AND ativo = '$ativo'"; //PARA SABER A dataVencimento E O estado DA QUOTA CORRESPONDENTE AO UTILIZADOR QUE TEM SESSAO INICIADA SESSAO
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $dataVencimento = $row['dataVencimento'];

                    if(($dataSistema > $dataVencimento)) //Verifica se a data de pagamento das quotas é inferior à data atual
                    {
                        $sql = "SELECT MAX(codQuota) AS codQuota FROM quota WHERE codUtilizador = '$codUtilizador'";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);
                        $codQuota = $row['codQuota'];
                        

                        $sql = "SELECT saldo FROM carteira AS c INNER JOIN utilizador AS u ON (c.codCarteira = u.codCarteira) WHERE u.codUtilizador = '$codUtilizador'";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);
                        $saldo = $row['saldo'];
                        

                        $estado = false;
                        $sql = "SELECT valor FROM tipoquota AS tq INNER JOIN quota AS q ON tq.codTipo = q.tipoQuota WHERE q.codUtilizador = '$codUtilizador' AND q.estado = '$estado'";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res);
                        $valor = $row['valor'];
                        

                        if($saldo < $valor)
                        {
                            $_SESSION['divida'] = 1;
                            $updateSaldo = $saldo - $valor;
                            $codConta = 2; // 2 diz respeito à CONTA DE QUOTAS

                            $sql = "SELECT codCarteira FROM utilizador WHERE codUtilizador = '$codUtilizador'";
                            $res = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($res);
                            $codCarteira = $row['codCarteira'];
                            

                            $sql = "UPDATE carteira SET saldo = '$updateSaldo' WHERE codCarteira = '$codCarteira'";
                            $res = mysqli_query($conn, $sql);



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

                            $sql = "INSERT INTO transacao (codTransacao, codConta, codCarteira, valor, data, ativo) VALUES ('$codTransacao', '$codConta', '$codCarteira', '$valor', '$dataSistema', '$ativo')";
                            $res = mysqli_query($conn, $sql);


                            $sql = "SELECT saldo FROM tesouraria WHERE codConta = '$codConta'";
                            $res = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($res);
    
                            $tesouraria = $row['saldo'] + $valor;
    
                            $sql = "UPDATE tesouraria SET saldo = '$tesouraria' WHERE codConta = '$codConta'";
                            $res = mysqli_query($conn, $sql);

                        }
                        else
                        {
                            $estado = false;
                            $sql = "SELECT codCarteira FROM utilizador WHERE codUtilizador = '$codUtilizador'";
                            $res = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($res);
                            $codCarteira = $row['codCarteira'];

                            $updateSaldo = $saldo - $valor;

                            $lastDateNextMonth =strtotime('last day of next month') ; //Ultimo dia no mês seguinte ao atual
                            $lastDay = date('Y-m-d', $lastDateNextMonth);
                            
                            $sql = "UPDATE carteira SET saldo = '$updateSaldo' WHERE codCarteira = '$codCarteira'"; //Atualiza o saldo da carteira
                            $res = mysqli_query($conn, $sql);

                            $sql = "UPDATE quota SET estado = 1 WHERE codUtilizador = '$codUtilizador' AND estado = '$estado'"; //Atualiza o esatdo das quotas
                            $res = mysqli_query($conn, $sql);

                            $sql = "SELECT MAX(codQuota) AS codQuota, tipoQuota AS tipoQuota FROM quota"; //Seleciona o maior CodQuota na BD
                            $res = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($res);

                            $codQuota = $row['codQuota'] + 1;
                            $tipoQuota = $row['tipoQuota'];
                            $ativo = true;

                            $sql = "INSERT INTO quota (codQuota, codUtilizador, tipoQuota, dataVencimento, estado, ativo) VALUES ('$codQuota', '$codUtilizador', '$tipoQuota', '$lastDay', '$estado', '$ativo')"; //Novo registo na BD
                            $res = mysqli_query($conn, $sql);


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


                            $codConta = 2; // 2 diz respeito à CONTA DE QUOTAS
                            $sql = "INSERT INTO transacao (codTransacao, codConta, codCarteira, valor, data, ativo) VALUES ('$codTransacao', '$codConta', '$codCarteira', '$valor', '$dataSistema', '$ativo')";
                            $res = mysqli_query($conn, $sql);


                            $sql = "SELECT saldo FROM tesouraria WHERE codConta = '$codConta'";
                            $res = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($res);
    
                            $tesouraria = $row['saldo'] + $valor;
    
                            $sql = "UPDATE tesouraria SET saldo = '$tesouraria' WHERE codConta = '$codConta'";
                            $res = mysqli_query($conn, $sql);

                        }
                    }



                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Login efetuado com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../clean.php";
                }
            }    

            //Faz include do ficheiro "script.php" onde consta as funções JS
            include '../include/script.php';
        ?>
    </body>
</html>