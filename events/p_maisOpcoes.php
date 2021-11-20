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

            $codEvento = $_GET['codEvento'];
            $_SESSION['codEvento'] = $codEvento;
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
        <h1>Os Meus Eventos</h1>
        <h3>Mais opções</h3>
        <div class='opcions_box'>
            <ul class='list_options'>
                <li><a href='p_addImagens.php'>Adicionar imagens</a></li>
                <li><a href='p_addVideo.php'>Adicionar videos</a></li>
            </ul>
        </div>

    </body>
</html>