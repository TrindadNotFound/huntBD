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
            include '../database/basedados.h';
            include '../include/perfil.php';

            if(isset($_SESSION['utilizador']))
            {
                $nomeUser = $_SESSION['utilizador'];
            
                $sql = "SELECT * FROM utilizador WHERE nomeUser='$nomeUser'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
            
                if($row['codPerfil'] == ADMIN)
                {
        ?>
                    <header>
                        <div class='navbar'>
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
                    $ativo = true;
                    $codAnimal = $_GET['codAnimal'];
                    $sql = "SELECT * FROM tipoanimal WHERE codAnimal = '$codAnimal'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

                    $_SESSION['codAnimal'] = $row['codAnimal'];


                    echo
                    "
                    <div class='grid-container'>
                        <div class='grid-item'>
                            <form action='updateAnimal.php' method='POST'>
                                <label for='animal'>Especie animal </label>
                                <input type='text' name='animal' value='".$row['especie']."'>                           
                                <input type='submit' value='Alterar'>
                            </form>
                        </div>

                        <div class='grid-item'>
                            <h1>Editar Especie Animal</h1>
                            <p>O Administrador pode fazer as alterações necessarias nas especies animais registadas na plataforma da Associação de Caça</p>
                            <p>As alterações devem ser feitas com responsabilidade</p>
                        </div>
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