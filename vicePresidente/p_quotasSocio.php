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
            session_start();

            include '../include/perfil.php';
            include '../database/basedados.h';
            include '../include/function.php';

            if(isset($_SESSION['utilizador']))
            {
                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
    
                    
                if($row['codPerfil'] == VICE_PRESIDENTE || $row['codPerfil'] == PRESIDENTE)
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
                    $codUtilizador = $_GET['codUtilizador'];

                    $sql = "SELECT nome, apelido FROM utilizador WHERE codUtilizador = '$codUtilizador'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    $nomeUtilizador = $row['nome'];
                    $apelidoUtilizador = $row['apelido'];


                    $sql = "SELECT tq.descricao, q.dataVencimento, q.estado FROM quota AS q INNER JOIN tipoQuota AS tq ON (q.tipoQuota = tq.codTipo) WHERE q.codUtilizador = '$codUtilizador'";
                    $res = mysqli_query($conn, $sql);
                    
                    echo
                    "
                    <br>
                    <br>
                    <h1>Quotas de Sócios</h1>
                        <h3>Utilizador - ".$nomeUtilizador." ".$apelidoUtilizador."</h3>
                        <div class='content_table'>
                            <table width='100%'>
                                <thead>
                                    <tr>
                                        <th>Data de Vencimento</th>
                                        <th>Tipo de quota</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                    ";

                    while($row = mysqli_fetch_array($res))
                    {
                                
                            echo"<tbody>
                                    <tr>
                                        <td>".$row['dataVencimento']."</td>
                                        <td>".$row['descricao']."</td>";
                                        if($row['estado'] == 1)
                                        {
                                            echo"<td>Vencido</td>";
                                        }
                                        else
                                        {
                                            echo"<td>Por vencer</td>";
                                        }
                                    echo"    
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