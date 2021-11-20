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

                    <div class="grid-container">
                        <div class="grid-item">
                            <form action="addUtilizador.php" method="POST">
                                <input type="text" name="nome" placeholder="Nome">
                                <input type="text" name="apelido" placeholder="Apelido">
                                <input type="date" name="dataNascimento" placeholder="Data nascimento">
                                <br>
                                <input type="text" name="morada" placeholder="Morada">
                                <input type="text" name="telemovel" placeholder="Telefone">
                                <input type="text" name="email" placeholder="Email">
                                <br>
                                <input type="text" name="nif" placeholder="NIF">
                                <input type="text" name="limitacao" placeholder="Limitações fisicas">
                                <input type="text" name="restricaoAlimentar" placeholder="Restrições alimentares">
                                <br>

                                <input type="text" name="numPorteArma" placeholder="Nº licença porte arma">
                                <input type="text" name="numApoliceSeguro" placeholder="Nº apólice de seguro">
                                <input type="text" name="numLicencaCaca" placeholder="Nº licença de caça">
                                <br>
                                <input type="text" name="nomeUser" placeholder="Nome de utilizador">
                                <input type="password" name="pw" placeholder="Palavra-passe">
                                <input type="submit" value="Registar">
                            </form>
                        </div>

                        <div class="grid-item">
                            <h1>Administrador - Registo de utilizador</h1>
                            <p>Como Administrador pode registar novos utilizadores na plataforma da Associação de Caça.</p>
                            <p>Apesar de ter o privilégio de o poder fazer, deve sempre introduzir os dados validos, provenientes dos utilizadores</p>
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