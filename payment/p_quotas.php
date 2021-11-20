<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Associação de caça</title>
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

                

                if($row['codPerfil']!=DESATIVADO && $row['codPerfil']!=POR_VALIDAR)
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

                    <br>
                    <br>
                    <h1>Quotas</h1>
                    <div class='opcions_box'>
                        <ul class='list_options'>
                            <li><a href='p_fundos.php'>Adicionar fundos</a></li>
                            <li><a href='p_consultarQuotas.php'>Consultar Quotas</a></li>
                        </ul>
                    </div>";
        <?php
                
                }
                else
                {
                    header('refresh:0; logout/logout.php');
                }
            }
            else
            {
                header('refresh:0; logout/logout.php');
            }
        ?>
    </body>
</html>