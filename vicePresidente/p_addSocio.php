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

        <div class="grid-container">
            <div class="grid-item">
                <form action="addSocio.php" method="POST">
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
                <h1>Novo Sócio</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis ante est. Integer id viverra libero. Praesent non semper urna. Duis lobortis quis ipsum in faucibus. Phasellus id enim posuere, congue diam at, accumsan purus. Nulla ultricies condimentum congue. Maecenas sem ex, pulvinar at erat vel, lobortis ultrices justo. Sed sit amet metus in libero laoreet finibus nec eu nisl.</p>
                <p>Suspendisse semper felis ut consequat pharetra. Ut nec hendrerit nunc. Phasellus ut tellus nibh. Suspendisse eget justo mi. Nunc tempus magna vel porta viverra. Vestibulum tempus velit sit amet mattis fermentum. Sed nec imperdiet justo, vitae iaculis diam. Vestibulum metus ante, fermentum in leo at, finibus venenatis massa. Proin porta scelerisque lectus in iaculis. Maecenas sed sem neque. Pellentesque quis sem eget quam rutrum pulvinar et ut nisi. Curabitur tincidunt quam a lacus convallis rhoncus. Suspendisse mi nisi, condimentum eu commodo quis, venenatis efficitur metus. Integer feugiat pharetra nisl ac lacinia. Aenean lacinia odio non semper finibus. Praesent nunc metus, dictum non mattis quis, viverra sed purus.</p>
            </div>

        </div>
    </body>
</html>