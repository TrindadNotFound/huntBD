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
                    $codLocalizacao = $_GET['codLocalizacao'];
                    $sql = "SELECT * FROM localizacao WHERE codLocalizacao = '$codLocalizacao'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

                    $_SESSION['codLocalizacao'] = $row['codLocalizacao'];//Para fazer o UPDATE na pagina "updatelocalizacao.php"


                    echo
                    "
                    <div class='grid-container'>
                        <div class='grid-item'>
                            <form action='updateLocalizacao.php' method='POST'>
                                <label for='morada'>Morada </label>
                                <input type='text' name='morada' value='".$row['morada']."'>
                                <br>

                                <label for='mancha'>Mancha </label>
                                <input type='text' name='mancha' value='".$row['mancha']."'>                            
                                <input type='submit' value='Alterar'>
                            </form>
                        </div>

                        <div class='grid-item'>
                            <h1>Editar Localização</h1>
                            <p>Caso seja necessario, o Administrador pode sempre realizar alterações nas informações das localizações</p>
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