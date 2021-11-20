<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <title>Associação de Caça</title>
    </head>
    <body>
        <?php
            session_start();

            include '../include/perfil.php';
            include '../database/basedados.h';
            include '../include/function.php';

            if(isset($_SESSION['utilizador']))
            {
                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
    
                
    
                if($row['codPerfil'] == VICE_PRESIDENTE || $row['codPerfil'] == ADMIN || $row['codPerfil'] == PRESIDENTE)
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

                    $sql = "SELECT t.codTransacao, t.data, te.descricao AS conta, u.nomeUser AS utilizador, t.valor FROM transacao AS t INNER JOIN carteira AS c ON (t.codCarteira = c.codCarteira) INNER JOIN tesouraria AS te ON (te.codConta = t.codConta) INNER JOIN utilizador AS u ON (u.codCarteira = c.codCarteira)";
                    $res = mysqli_query($conn, $sql);
                    
                    echo
                    "
                    <h1>Tesouraria</h1>
                    <h3>Transações</h3>
                        <div class='content_table'>
                            <table id='table-datatable' width='100%'>
                                <thead>
                                    <tr>
                                        <th>Código Transação</th>
                                        <th>Data</th>
                                        <th>Conta</th>
                                        <th>Utilizador</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                    ";

                    while($row = mysqli_fetch_array($res))
                    {
                                
                            echo"<tbody>
                                    <tr>
                                        <td>".$row['codTransacao']."</td>
                                        <td>".$row['data']."</td>
                                        <td>".$row['conta']."</td>
                                        <td>".$row['utilizador']."</td>
                                        <td>".$row['valor']." €</td>
                                    </tr>
                                </tbody>";
                    }
                    echo"            
                            </table>
                        </div>
                    ";



                    $sql = "SELECT * FROM tesouraria WHERE ativo = true";
                    $res = mysqli_query($conn, $sql);
                    
                    echo
                    "
                    <h3>Contas da Associação</h3>
                        <div class='content_table'>
                            <table width='100%'>
                                <thead>
                                    <tr>
                                        <th>Código Conta</th>
                                        <th>Descrição</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                    ";

                    while($row = mysqli_fetch_array($res))
                    {
                                
                            echo"<tbody>
                                    <tr>
                                        <td>".$row['codConta']."</td>
                                        <td>".$row['descricao']."</td>
                                        <td>".$row['saldo']." €</td>
                                    </tr>
                                </tbody>";
                    }
                    echo"            
                            </table>
                        </div>
                    ";
                }
                else
                {
                    header('refresh:0; ../index.php');
                }
            }
            else
            {
                header('refresh:0; ../index.php');
            }  
        ?>
    </body>
</html>