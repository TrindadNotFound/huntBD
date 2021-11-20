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
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="../register/p_register.php">Ser sócio</a></li>
                <li><a href='../p_eventosPublico.php'>Calendario de Eventos</a></li>
                <li><a href="../about.php">Quem somos</a></li>
                <li><a href="../gallery.php">Galeria</a></li>
                <li><a href="../login/p_login.php">Iniciar sessão</a></li>
            </ul>
        </div>
    </header>

    <div class="grid-container">
        <div class="grid-item">
            <form action="register.php" method="POST">
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
            <h1>Ser Sócio</h1>
            <p>Atraves deste formulario pode se tornar sócio da Associação de Caça. Simples!</p>
            <p>Disponha de inumeras aventuras em conjunto com os seus amigos de caça, pelas terras da Penísula Ibérica </p>
            </div>

    </div>
</body>
</html>