<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Associação de caça</title>
</head>
    <body>
        <?php
            session_start();

            include 'include/perfil.php';
            include 'database/basedados.h';
            
            if(isset($_SESSION['utilizador']))
            {
                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);

                

                if($row['codPerfil']!=DESATIVADO || $row['codPerfil']!=POR_VALIDAR)
                {
        ?>
                    <header>
                        <div class="navbar">
                            <h1>Associação de caça</h1>
                            <ul>
                                <li><a href='index.php'>Inicio</a></li>
                                <li><a href='about.php'>Quem somos</a></li>
                                <li><a href='gallery.php'>Galeria</a></li>
                                <li><a href='p_areaPessoal.php'>Área Pessoal</a></li>
                                <li><a href='logout/logout.php'>Terminar sessão</a></li>
                            </ul>
                        </div>
                    </header>
        <?php
                
                    switch ($row['codPerfil'])
                    {
                        case ADMIN:
                            echo"
                            <div class='opcions_box'>
                                <ul class='list_options'>
                                    <li><a href='admin/p_gestUtilizadores.php'>Gestão de Utilizadores</a></li>
                                    <li><a href='admin/p_gestEventosLocalizacoes.php'>Gestão de Eventos e Localizações</a></li>
                                    <li><a href='admin/p_maisPresidencia.php'>Presidência</a></li>
                                    <li><a href='admin/p_maisOpcoes.php'>Mais ...</a></li>
                                </ul>
                            </div>";
                        break;

                        case PRESIDENTE:
                            echo"
                            <div class='opcions_box'>
                                <ul class='list_options'>
                                    <li><a href='vicePresidente/p_gestSocios.php'>Gestão de Sócios</a></li>
                                    <li><a href='vicePresidente/p_gestEventos.php'>Gestão de Eventos</a></li>
                                    <li><a href='vicePresidente/p_gestContas.php'>Gestão de Contas da Associação</a></li>
                                    <li><a href='vicePresidente/p_maisOpcoes.php'>Mais ...</a></li>
                                </ul>
                            </div>";
                        break;

                        case VICE_PRESIDENTE:
                            echo"
                            <div class='opcions_box'>
                                <ul class='list_options'>
                                    <li><a href='vicePresidente/p_gestSocios.php'>Gestão de Sócios</a></li>
                                    <li><a href='vicePresidente/p_gestEventos.php'>Gestão de Eventos</a></li>
                                    <li><a href='vicePresidente/p_gestContas.php'>Gestão de Contas da Associação</a></li>
                                    <li><a href='vicePresidente/p_maisOpcoes.php'>Mais ...</a></li>
                                </ul>
                            </div>";
                        break;

                        case SECRETARIO:
                            echo"
                            <div class='opcions_box'>
                                <ul class='list_options'>
                                    <li><a href='socio/p_dadosPessoais.php'>Dados pessoais</a></li>
                                    <li><a href='events/p_eventos.php'>Eventos</a></li>
                                    <li><a href='payment/p_quotas.php'>Quotas</a></li>
                                    <li><a href='secretario/p_gerirAtas.php'>Atas</a></li>
                                </ul>
                            </div>";
                        break;

                        case SOCIO:
                            echo"
                            <div class='opcions_box'>
                                <ul class='list_options'>
                                    <li><a href='socio/p_dadosPessoais.php'>Dados pessoais</a></li>
                                    <li><a href='events/p_eventos.php'>Eventos</a></li>
                                    <li><a href='payment/p_quotas.php'>Quotas</a></li>
                                </ul>
                            </div>";
                        break;
                    }
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