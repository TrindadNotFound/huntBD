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
                $nomeUser = $_GET['nomeUser'];
            
                $sql = "SELECT * FROM utilizador WHERE nomeUser='$nomeUser'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
                
                $_SESSION['codUtilizador'] = $row['codUtilizador'];
                $codUtilizador = $row['codUtilizador'];

                echo
                "
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


                <div class='grid-container'>
                    <div class='grid-item'>
                        <form action='updateDadosAdmin.php' method='POST'>
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
                            <input type='text' name='numLicencaCaca' placeholder='Nº licença de caça' value='".$row['numLicencaCaca']."'>";
        ?>                    
                            <br>
                            <select name="tipo_utilizador">
                                <?php
                                    $sql_tipo_perfil = "SELECT descricao FROM utilizador AS u INNER JOIN tipoperfil AS tp ON (u.codPerfil = tp.codTipo) WHERE codUtilizador = '$codUtilizador'";
                                    $res_tipo_perfil = mysqli_query($conn, $sql_tipo_perfil);
                                    $row_tipo_perfil = mysqli_fetch_array($res_tipo_perfil);
                                    $tipoPerfil = $row_tipo_perfil['descricao'];
                                ?>

                                <option selected hidden>
                                    <?php
                                        echo $tipoPerfil; 
                                    ?>
                                </option>

                                <?php
                                    $sql_tipo_user = "SELECT * FROM tipoperfil WHERE codTipo != 6 AND codTipo != 7 AND codTipo != 2";
                                    $res_tipo_user = mysqli_query($conn, $sql_tipo_user);

                                    while($row_tipo_user = mysqli_fetch_array($res_tipo_user))
                                    {
                                        echo"<option value='".$row_tipo_user['codTipo']."'>".$row_tipo_user['descricao']."</option>";
                                    } 
                                ?>
                            </select>
        <?php
                            echo"
                            <input type='text' name='nomeUser' placeholder='Nome de utilizador' value='".$row['nomeUser']."'>
                            <input type='password' name='pw' placeholder='Palavra-passe'>
                            <br>

                            <input type='submit' value='Alterar'>
                        </form>
                    </div>

                    <div class='grid-item'>
                        <h1>Gestão de dados dos utilizadores</h1>
                        <p>Como Administrador pode gerir os dados pessoais dos utilizadores da Associação de Caça.</p>
                        <p>Como esse privilégio, deve ter em atenção as alterações que realiza.</p>
                    </div>
                </div>
                ";
                
            }
            else
            {
                header('refresh:0; ../index.php');
            }
        ?>
    </body>
</html>