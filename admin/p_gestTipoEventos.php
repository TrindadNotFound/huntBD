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
    
                
    
                if($row['codPerfil'] = ADMIN)
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
                   
                   $sql = "SELECT te.codTipo, te.descricao AS descricaoTipo, ta.codArma AS codArma, ta.descricao AS descricaoArma FROM tipoarma AS ta INNER JOIN armaevento AS ae ON (ta.codArma = ae.codArma) INNER JOIN tipoevento AS te ON (te.codTipo = ae.codTipo)";
                   $res = mysqli_query($conn, $sql);
                    

                    echo
                    "
                    <br>
                    <h1>Gestão de Tipo de Eventos</h1>
                        <div class='content_table'>
                            <table width='100%'>
                                <thead>
                                    <tr>
                                        <th>
                                            <a href='p_addtipoEvento.php'>➕ Novo Tipo de Evento</a>
                                        </th>
                                        <th>Código Tipo de Evento</th>
                                        <th>Tipo de Evento</th>
                                        <th>Arma utilizada</th>                                        
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
                                        <td>".$row['codTipo']."</td>
                                        <td>".$row['descricaoTipo']."</td>
                                        <td>".$row['descricaoArma']."</td>
                                        <td><a href='p_editarTipoEvento.php?codtipo=".$row["codTipo"]."&codArma=".$row['codArma']."'>✏️ Editar</a></td>";
                                        
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
            }
            else
            {
                header('refresh:0; ../index.php');
            }

            
        ?>
    </body>
</html>