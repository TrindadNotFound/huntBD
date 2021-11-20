<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
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
            session_start(); 
            include '../database/basedados.h';

            $sql = "SELECT i.imagem, v.video, u.nome, e.descricao FROM imagem AS i INNER JOIN utilizador AS u ON (i.codUtilizador = u.codUtilizador) INNER JOIN video AS v ON (v.codUtilizador = u.codUtilizador) INNER JOIN evento AS e ON (i.codEvento = e.codEvento)
            ";
            $res = mysqli_query($conn, $sql);

            echo"
            <br>
            <br>
            <h1>Ver Multimédia</h1>
            <div class='content_table'>
                <table width='100%'>
                    <thead>
                        <tr>
                            <th>Evento</th>
                            <th>Publicado por</th>
                            <th>Imagens</th>
                            <th>Videos</th>
                        </tr>
                    </thead>
            ";

            while($row = mysqli_fetch_array($res))
            {
            echo"
                    <tbody>
                        <tr>
                            <td>".$row['descricao']."</td>
                            <td>".$row['nome']."</td>
                            <td>
                                <a href='../img_event/".$row['imagem']."'>
                                    <img src='../img_event/".$row['imagem']."' width='200' height='100'>
                                </a>
                            </td>
                            <td>
                                <video controls width='200' height='100'>
                                    <source src='../video_event/".$row['video']."'>
                                </video>
                            </td>
                        </tr>
                    </tbody>
            ";
            }
            
            echo"
                </table>
            </div>
";

        ?>
    </body>
</html>