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
                                <li><a href='../p_areaPessoal.php'>Área Pessoal</a></li>
                                <li><a href='../logout/logout.php'>Terminar sessão</a></li>
                            </ul>
                        </div>
                    </header>

                    <div class="grid-container">
                        <div class="grid-item">
                            <form action="addArma.php" method="POST">
                                <input type="text" name="arma" placeholder="Arma">
                                <br>
                                <input type="text" name="tipotiro" placeholder="Tipo de tiro">
                                <label for='silenciador'>Silenciador</label>
                                <input type='checkbox' name='silenciador'>

                                <input type="submit" value="Registar">
                            </form>
                        </div>

                        <div class="grid-item">
                            <h1>Nova arma</h1>
                            <p>O Administrador tem a possibilidade de registar uma nova arma na plataforma da Associação de Caça para que seja referida como "permitida" nos eventos</p>
                            <p>Os registos apenas devem ser feitos quando necessario.</p>
                        </div>
                    </div>

        <?php
                }
            }


        ?>
        
    </body>
</html>