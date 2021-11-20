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
                                <!--<li><a href='#'>Ser sócio</a></li>-->
                                <li><a href='../about.php'>Quem somos</a></li>
                                <li><a href='../gallery.php'>Galeria</a></li>
                                <li><a href='../p_areaPessoal.php'>Area Pessoal</a></li>
                                <li><a href='../logout/logout.php'>Terminar sessão</a></li>
                            </ul>
                        </div>
                    </header>

                    <div class="grid-container">
                        <div class="grid-item">
                            <form action="addLocalizacao.php" method="POST">
                                <label for="morada">Morada </label>
                                <input type="text" name="morada">
                                <br>
                                <label for="mancha">Mancha </label>
                                <input type="text" name="mancha">
                                <input type="submit" value="Registar">
                            </form>
                        </div>

                        <div class="grid-item">
                            <h1>Nova localização</h1>
                            <p>O Administrador é responsavel pelo registo de novas localizações para os eventos de caça</p>
                            <p>Tem que ter em atenção que somente deve proceder ao registo de novas localizações quando o mesmo for pedido</p>
                        </div>
                    </div>

        <?php
                }
            }


        ?>
        
    </body>
</html>