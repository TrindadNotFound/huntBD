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

            include '../include/perfil.php';
            include '../database/basedados.h';

            if(isset($_SESSION['utilizador']))
            {
                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
    
                
    
                if($row['codPerfil'] == SECRETARIO || $row['codPerfil'] == VICE_PRESIDENTE || $row['codPerfil'] == PRESIDENTE || $row['codPerfil'] == ADMIN)
                {
        ?>
                    <header>
                        <div class="navbar">
                            <h1>Associação de caça</h1>
                            <ul>
                                <li><a href='../index.php'>Inicio</a></li>
                                <li><a href='../about.php'>Quem somos</a></li>
                                <li><a href='../gallery.php'>Galeria</a></li>
                                <li><a href='../p_areaPessoal.php'>Area Pessoal</a></li>
                                <li><a href='../logout/logout.php'>Terminar sessão</a></li>
                            </ul>
                        </div>
                    </header>
        <?php
                   $ativo = true;
                   $sql = "SELECT codEvento, data, descricao, ata FROM evento WHERE ativo = '$ativo'";
                   $res = mysqli_query($conn, $sql);
                    

                    echo
                    "
                    <h1>Gestão de Atas de Eventos</h1>
                        <div class='content_table'>
                            <table width='100%'>
                                <thead>
                                    <tr>
                                        <th>Código Evento</th>
                                        <th>Data</th>
                                        <th>Evento</th>
                                        <th>Ata</th>
                                    </tr>
                                </thead>
                    ";
                    while($row = mysqli_fetch_array($res))
                    {
                                echo
                                "
                                <tbody>
                                    <tr>
                                        <td>".$row['codEvento']."</td>
                                        <td>".$row['data']."</td>
                                        <td>".$row['descricao']."</td>";
                                        if(empty($row['ata']))
                                        {
                                            echo"<td>Sem ata</td>";
                                        }
                                        else
                                        {
                                            echo"
                                            <td style='max-width:100px' class='cut'>".$row['ata']."</td>
                                            ";
                                        }

                                        
                                        echo"
                                        <td><a href='p_editarAta.php?codEvento=".$row["codEvento"]."'>👓 Editar/Consultar</a></td>
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
            }
            else
            {
                header('refresh:0; ../index.php');
            } 
        ?>
        <script src='../js/shave.js'></script>
       <script src='../js/cutText.js'></script>
    </body>
</html>