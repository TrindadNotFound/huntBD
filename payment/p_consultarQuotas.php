<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Associação de caça</title>
</head>
<body>

    <?php
        session_start();
        
        unset($_SESSION['title']);
        unset($_SESSION['text']);
        unset($_SESSION['icon']);
        unset($_SESSION['url']);

        include '../include/perfil.php';
        include '../database/basedados.h';


        if(isset($_SESSION['utilizador']))
        {
            if(isset ($_SESSION['divida']) AND $_SESSION['divida'] = 1) //Verifica se a variavel de sessao ainda esta criada e, verifica o seu valor
            {
                
                $_SESSION['title'] = "Atenção";
                $_SESSION['text'] = "O seu saldo não foi suficiente para liquidar as quotas em divida";
                $_SESSION['icon'] = "warning"; 
                $_SESSION['url'] = "../payment/clean_consultarQuotas.php";
            }
            else
            {
                $sql = "SELECT * FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);

                $codUtilizador = $row['codUtilizador'];
                

                if($row['codPerfil']!=DESATIVADO && $row['codPerfil']!=POR_VALIDAR)
                {
    ?>
                    <header>
                        <div class="navbar">
                            <h1>Associação de caça</h1>
                            <ul>
                                <li><a href='../index.php'>Inicio</a></li>
                                <li><a href='../about.php'>Quem somos</a></li>
                                <li><a href='../gallery.php'>Galeria</a></li>
                                <li><a href='../p_areaPessoal.php'>Área Pessoal</a></li>
                                <li><a href='../logout/logout.php'>Terminar sessão</a></li> 
                            </ul>
                        </div>
                    </header>
    <?php
                    $sql = "SELECT q.dataVencimento, q.estado, tq.descricao, tq.valor FROM quota AS q INNER JOIN tipoQuota AS tq ON (q.tipoQuota = tq.codTipo) WHERE q.codUtilizador = '$codUtilizador'";
                    $res = mysqli_query($conn, $sql);
                


                    echo
                    "
                    <br>
                    <br>
                    <h1>Consultar Quotas</h1>
                    <div class='content_table'>
                        <table width='100%'>
                            <thead>
                                <tr>
                                    <th>Data de vencimento</th>
                                    <th>Tipo de quota</th>
                                    <th>Valor</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                    ";

                    while($row = mysqli_fetch_array($res))
                    {
                        if ($row['estado'] == 0)
                        {
                            $estado = "Por vencer";
                        }
                        else
                        {
                            $estado = "Vencido";
                        }
                        echo
                        "
                            <tbody>
                                <tr>
                                    <td>".$row['dataVencimento']."</td>
                                    <td>".$row['descricao']."</td>
                                    <td>".$row['valor']." € </td>
                                    <td>".$estado."</td>
                                </tr>
                            </tbody>
                        ";
                    }  
                    echo
                    "
                        </table>
                    </div>
                    ";

                

                }
                else
                {
                    header('refresh:0; ../logout/logout.php');
                }
            }
        }
        else
        {
            header('refresh:0; ../logout/logout.php');
        }

        
        //Faz include do ficheiro "script.php" onde consta as funções JS
        include '../include/script.php';
    ?>
</body>
</html>