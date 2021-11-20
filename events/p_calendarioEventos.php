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
            $sql = "SELECT * FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($res);


            

            if($row['codPerfil']!=DESATIVADO && $row['codPerfil']!=POR_VALIDAR)
            {
                $codUtilizador = $row['codUtilizador'];
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

                $sql = "SELECT e.codEvento, e.preco, e.vagaatual, e.data, e.descricao, l.morada, e.ativo 
                        FROM evento AS e INNER JOIN localizacao AS l ON (e.codLocalizacao = l.codLocalizacao) 
                        WHERE e.codEvento NOT IN 
                                        (SELECT codEvento FROM eventoutilizador WHERE codUtilizador = '$codUtilizador') 
                        AND e.ativo = true";

                $res = mysqli_query($conn, $sql);
            
                echo
                "
                <br>
                <br>
                <h1>Calendário de Eventos</h1>
                <div class='content_table'>
                    <table width='100%'>
                        <thead>
                            <tr>
                                <th>Evento</th>
                                <th>Localização</th>
                                <th>Data</th>
                                <th>Vagas</th>
                                <th>Preço</th>
                                <th>Inscrição</th>
                            </tr>
                        </thead>
                ";
                        while($row = mysqli_fetch_array($res))
                        {
                            if($row['data']>= $dataSistema)
                            {
                                echo
                                "
                                <tbody>
                                    <tr>
                                        <td>".$row['descricao']."</td>
                                        <td>".$row['morada']."</td>
                                        <td>".$row['data']."</td>
                                        <td>".$row['vagaatual']."</td>
                                        <td>".$row['preco']." €</td>";
                                        
                                        if($row['vagaatual'] == 0)
                                        {
                                            echo"
                                            <td>
                                                <a>❌ Sem vagas</a>
                                            </td>";
                                        }
                                        else
                                        {
                                            echo"
                                            <td>
                                                <a href='inscricaoEvento.php ? codEvento=".$row['codEvento']."'>✔️ Inscrever</a>
                                            </td>";
                                        }
    
                                    echo"
                                    </tr>
                                </tbody>
                                ";
                            }
                            
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