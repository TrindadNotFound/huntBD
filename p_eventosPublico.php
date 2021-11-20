<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Associação de caça</title>
</head>
    <body>
        <?php
            session_start();
            include 'database/basedados.h';
        
        ?>
                    <header>
                        <div class="navbar">
                            <h1>Associação de caça</h1>
                            <ul>
                                <li><a href='index.php'>Inicio</a></li>
                                <li><a href='register/p_register.php'>Ser sócio</a></li>
                                <li><a href='p_eventosPublico.php'>Calendario de Eventos</a></li>
                                <li><a href='about.php'>Quem somos</a></li>
                                <li><a href='gallery.php'>Galeria</a></li>
                                <li><a href='login/p_login.php'>Iniciar sessão</a></li>
                            </ul>
                        </div>
                    </header>

        <?php
                    date:date_default_timezone_set('GMT');
                    $dataSistema = date('Y-m-d');

                    $sql = "SELECT e.codEvento, e.preco, e.vagaatual, e.data, e.descricao, l.morada FROM evento AS e INNER JOIN localizacao AS l ON (e.codLocalizacao = l.codLocalizacao)
                            WHERE e.ativo = true";
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
                                            <td>".$row['preco']." €</td>
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

        ?>
    </body>
</html>