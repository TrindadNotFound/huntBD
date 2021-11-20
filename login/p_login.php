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
    <header>
        <div class="navbar">
            <h1>Associação de caça</h1>
            <ul>
                <li><a href='../index.php'>Inicio</a></li>
                <li><a href='../register/p_register.php'>Ser sócio</a></li>
                <li><a href='../p_eventosPublico.php'>Calendario de Eventos</a></li>
                <li><a href='../about.php'>Quem somos</a></li>
                <li><a href='../gallery.php'>Galeria</a></li>
                <li><a href='p_login.php'>Iniciar sessão</a></li>
            </ul>
        </div>
    </header>

    <?php
        session_start();
        echo
        "
        <form class='login_box' action='login.php' method='POST'>
            <h1>Iniciar sessão</h1>
            <input type='text' name='nomeUser' placeholder='Nome Utilizador'>
            <input type='password' name='password' id='pw' placeholder='Senha'>
            <label for='verPassword'> Ver senha </label>
            <input type='checkbox' name='verPassowrd' onclick='verPassword()'>
            <br>

            <input type='submit' name='' value='Iniciar sessão'>
            <a href='../register/p_register.php'>Ainda não tem conta?</a>
        </form>
        ";

        include '../include/script.php';
    ?>

</body>
</html>