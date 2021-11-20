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
                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);

                if($row['codPerfil'] == VICE_PRESIDENTE || $row['codPerfil'] == PRESIDENTE)
                {
                    $codUtilizador = $_GET['codUtilizador'];
                
                    $sql = "SELECT * FROM utilizador WHERE codUtilizador='$codUtilizador'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
                    
                    $_SESSION['codUtilizador'] = $codUtilizador;


                    echo
                    "
                    <header>
                        <div class='navbar'>
                            <h1>Associação de caça</h1>
                            <ul>
                                <li><a href='../index.php'>Inicio</a></li>
                                <!--<li><a href='#'>Ser sócio</a></li>-->
                                <li><a href='../about.php'>Quem somos</a></li>
                                <li><a href='../gallery.php'>Galeria</a></li>
                                <li><a href='../p_areaPessoal.php'>Área Pessoal</a></li>
                                <li><a href='../logout/logout.php'>Terminar sessão</a></li>
                            </ul>
                        </div>
                    </header>


                    <div class='grid-container'>
                        <div class='grid-item'>
                            <form action='updateDadosVicePres.php' method='POST'>
                                <input type='text' name='nome' placeholder='Nome' value='".$row['nome']."'>
                                <input type='text' name='apelido' placeholder='Apelido' value='".$row['apelido']."'>
                                <input type='date' name='dataNascimento' placeholder='Data nascimento' value='".$row['dataNascimento']."'>
                                <br>
                                <input type='text' name='morada' placeholder='Morada' value='".$row['morada']."'>
                                <input type='text' name='telemovel' placeholder='Telefone' value='".$row['telemovel']."'>
                                <input type='text' name='email' placeholder='Email' value='".$row['email']."'>
                                <br>
                                <input type='text' name='nif' placeholder='NIF' value='".$row['nif']."'>
                                <input type='text' name='limitacao' placeholder='Limitações fisicas' value='".$row['limitacao']."'>
                                <input type='text' name='restricaoAlimentar' placeholder='Restrições alimentares' value='".$row['restricaoAlimentar']."'>
                                <br>

                                <input type='text' name='numPorteArma' placeholder='Nº licença porte arma' value='".$row['numPorteArma']."'>
                                <input type='text' name='numApoliceSeguro' placeholder='Nº apólice de seguro' value='".$row['numApoliceSeguro']."'>
                                <input type='text' name='numLicencaCaca' placeholder='Nº licença de caça' value='".$row['numLicencaCaca']."'>
                                <br>
                                <input type='text' name='nomeUser' placeholder='Nome de utilizador' value='".$row['nomeUser']."'>
                                <input type='password' name='pw' placeholder='Palavra-passe'>
                                <br>
                                <input type='submit' value='Alterar'>
                            </form>
                        </div>

                        <div class='grid-item'>
                            <h1>Dados pessoais</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis ante est. Integer id viverra libero. Praesent non semper urna. Duis lobortis quis ipsum in faucibus. Phasellus id enim posuere, congue diam at, accumsan purus. Nulla ultricies condimentum congue. Maecenas sem ex, pulvinar at erat vel, lobortis ultrices justo. Sed sit amet metus in libero laoreet finibus nec eu nisl.</p>
                            <p>Suspendisse semper felis ut consequat pharetra. Ut nec hendrerit nunc. Phasellus ut tellus nibh. Suspendisse eget justo mi. Nunc tempus magna vel porta viverra. Vestibulum tempus velit sit amet mattis fermentum. Sed nec imperdiet justo, vitae iaculis diam. Vestibulum metus ante, fermentum in leo at, finibus venenatis massa. Proin porta scelerisque lectus in iaculis. Maecenas sed sem neque. Pellentesque quis sem eget quam rutrum pulvinar et ut nisi. Curabitur tincidunt quam a lacus convallis rhoncus. Suspendisse mi nisi, condimentum eu commodo quis, venenatis efficitur metus. Integer feugiat pharetra nisl ac lacinia. Aenean lacinia odio non semper finibus. Praesent nunc metus, dictum non mattis quis, viverra sed purus.</p>
                        </div>
                    </div>
                    ";
                }    
            }
        ?>
    </body>
</html>