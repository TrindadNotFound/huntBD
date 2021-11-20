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
            
            if(isset($_SESSION['utilizador']))
            {
                echo
                "
                <header>
                    <div class='navbar'>
                        <h1>Associação de caça</h1>
                        <ul>
                            <li><a href='index.php'>Inicio</a></li>
                            <li><a href='about.php'>Quem somos</a></li>
                            <li><a href='#'>Galeria</a></li>
                            <li><a href='p_areaPessoal.php'>Área Pessoal</a></li>
                            <li><a href='logout/logout.php'>Terminar sessão</a></li>
                        </ul>
                    </div>
                </header>";
            }
            else
            {   
                echo
                "
                <header>
                    <div class='navbar'>
                        <h1>Associação de caça</h1>
                        <ul>
                            <li><a href='index.php'>Inicio</a></li>
                            <li><a href='register/p_register.php'>Ser sócio</a></li>
                            <li><a href='p_eventosPublico.php'>Calendario de Eventos</a></li>
                            <li><a href='about.php'>Quem somos</a></li>
                            <li><a href='gallery.php'>Galeria</a></li>
                            <li><a href='login/p_login.php'>Iniciar sessão</a></li>
                        </ul>
                    </div>
                </header>";
            }
        ?>

        <div class="grid-container">
            <div class="grid-item">
                <div class="slider"></div>
            </div>

            <div class="grid-item">
                <h1>Galeria</h1>
                <p>Os momentos devem ser partilhados com todos. A nossa galeria deixa um pouco das aventuras dos nossos caçadores</p>
            </div>
        </div>
    </body>
</html>