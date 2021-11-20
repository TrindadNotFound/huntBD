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
    
                
    
                if($row['codPerfil'] == ADMIN)
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
                   
                   $sql = "SELECT * FROM tipoanimal";
                   $res = mysqli_query($conn, $sql);
                    

                    echo
                    "
                    <h1>Gestão de Especies Animais</h1>
                        <div class='content_table'>
                            <table width='100%'>
                                <thead>
                                    <tr>
                                        <th>
                                            <a href='p_addAnimais.php'>➕</a>
                                        </th>
                                        <th>Código Animal</th>
                                        <th>Especie</th>
                                    </tr>
                                </thead>
                    ";
                    while($row = mysqli_fetch_array($res))
                    {
                                echo
                                "
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>".$row['codAnimal']."</td>
                                        <td>".$row['especie']."</td>
                                        <td><a href='p_editarAnimal.php?codAnimal=".$row["codAnimal"]."'>✏️ Editar</a></td>
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
    </body>
</html>