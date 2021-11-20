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

            include '../include/perfil.php';
            include '../database/basedados.h';
            
            if(isset($_SESSION['utilizador']))
            {
                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);

                

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
                    date:date_default_timezone_set('GMT');
                    $dataSistema = date('Y-m-d');

                    $sql = "SELECT codUtilizador FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

                    $codUtilizador = $row['codUtilizador'];


                    $sql = "SELECT e.codEvento, e.data, e.descricao, l.morada, pe.porta
                            FROM evento AS e 
                            INNER JOIN localizacao AS l ON (e.codLocalizacao = l.codLocalizacao)
                            INNER JOIN portaevento AS pe ON (pe.codEvento = e.codEvento) 
                            
                            WHERE pe.codUtilizador = '$codUtilizador'
                            
                            ORDER BY e.data DESC";
                            
                    $res = mysqli_query($conn, $sql);

                    echo
                    "
                    <br>
                    <br>
                    <h1>Os Meus Eventos</h1>
                    <div class='content_table'>
                        <table width='100%'>
                            <thead>
                                <tr>
                                    <th>Evento</th>
                                    <th>Localização</th>
                                    <th>Porta</th>
                                    <th>Data</th>
                                    <th></th>
                                </tr>
                            </thead>
                    ";
                            while($row = mysqli_fetch_array($res))
                            {
                                echo
                                "
                                <tbody>
                                    <tr>
                                        <td>".$row['descricao']."</td>
                                        <td>".$row['morada']."</td>
                                        <td>".$row['porta']."</td>
                                        <td>".$row['data']."</td>";

                                        if($dataSistema > $row['data'])
                                        {
                                            echo"
                                            <td>
                                                <a href='p_maisOpcoes.php?codEvento=".$row['codEvento']."'>Mais opções</a>                                       
                                            </td>";
                                        }
                                    echo"    
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
                    header('refresh:0; logout/logout.php');
                }
            }
            else
            {
                header('refresh:0; logout/logout.php');
            }
        ?>
    </body>
</html>