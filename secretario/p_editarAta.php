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
            include '../database/basedados.h';
            include '../include/perfil.php';

            if(isset($_SESSION['utilizador']))
            {
                $nomeUser = $_SESSION['utilizador'];
            
                $sql = "SELECT * FROM utilizador WHERE nomeUser='$nomeUser'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
            
                if($row['codPerfil'] == SECRETARIO || $row['codPerfil'] == VICE_PRESIDENTE || $row['codPerfil'] == PRESIDENTE || $row['codPerfil'] == ADMIN)
                {
        ?>
                    <header>
                        <div class='navbar'>
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
                    $codEvento = $_GET['codEvento'];

                    $sql = "SELECT ata FROM evento WHERE codEvento = '$codEvento'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

                    $_SESSION['codEvento'] = $codEvento;

        ?>            
                    
                    <div class='grid-container'>
                        <div class='grid-item'>
                            <form action='updateAta.php' method='POST'>
                                <h2> Ata de evento</h2>

                                <textarea  name='ata'><?php echo $row['ata']?></textarea>
                          
                                <input type='submit' value='Alterar'>

                            </form>
                        </div>

                        <div class='grid-item'>
                            <h1>Editar Ata de Evento</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis ante est. Integer id viverra libero. Praesent non semper urna. Duis lobortis quis ipsum in faucibus. Phasellus id enim posuere, congue diam at, accumsan purus. Nulla ultricies condimentum congue. Maecenas sem ex, pulvinar at erat vel, lobortis ultrices justo. Sed sit amet metus in libero laoreet finibus nec eu nisl.</p>
                            <p>Suspendisse semper felis ut consequat pharetra. Ut nec hendrerit nunc. Phasellus ut tellus nibh. Suspendisse eget justo mi. Nunc tempus magna vel porta viverra. Vestibulum tempus velit sit amet mattis fermentum. Sed nec imperdiet justo, vitae iaculis diam. Vestibulum metus ante, fermentum in leo at, finibus venenatis massa. Proin porta scelerisque lectus in iaculis. Maecenas sed sem neque. Pellentesque quis sem eget quam rutrum pulvinar et ut nisi. Curabitur tincidunt quam a lacus convallis rhoncus. Suspendisse mi nisi, condimentum eu commodo quis, venenatis efficitur metus. Integer feugiat pharetra nisl ac lacinia. Aenean lacinia odio non semper finibus. Praesent nunc metus, dictum non mattis quis, viverra sed purus.</p>
                        </div>
                    </div>
                   
        <?php

                }
            }
            else
            {
                header('refresh:0; ../index.php');
            }
        ?>
    </body>
</html>