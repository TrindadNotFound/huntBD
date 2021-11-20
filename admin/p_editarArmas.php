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
                                <li><a href='../p_areaPessoal.php'>Área Pessoal</a></li>
                                <li><a href='../logout/logout.php'>Terminar sessão</a></li>
                            </ul>
                        </div>
                    </header>
        <?php
                    $codArma = $_GET['codArma'];
                    $_SESSION['codArma'] = $codArma;
                    $sql = "SELECT * FROM tipoarma WHERE codArma = '$codArma'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

              


                    echo
                    "
                    <div class='grid-container'>
                        <div class='grid-item'>
                            <form action='updateArma.php' method='POST'>
                                <label for='arma'>Arma </label>
                                <input type='text' name='arma' value='".$row['descricao']."'>
                                <br>

                                <label for='tipotiro'>Tipo tiro </label>
                                <input type='text' name='tipotiro' value='".$row['especificacaoTiro']."'>

                                <label for='silenciador'>Silenciador </label>";
                                if($row['silenciador'] == 1 )
                                {
                                    echo"<input type='checkbox' name='silenciador' value='1' checked='checked'>
                                    <br>";
                                }
                                else
                                {
                                    echo"<input type='checkbox' name='silenciador' value='0'>
                                    <br>";

                                }
                                echo"
                                <input type='submit' value='Alterar'>
                            </form>
                        </div>

                        <div class='grid-item'>
                            <h1>Editar armamento</h1>
                            <p>Pode fazer a alteração da informação referente as armas que estão registadas na plataforma da Associação de Caça</p>
                            <p>As alterações devem ser feitas quando necessario.</p>
                        </div>
                    </div>
                    ";
        ?>
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