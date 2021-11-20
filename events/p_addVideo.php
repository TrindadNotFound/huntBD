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
                    <li><a href='../about.php'>Quem somos</a></li>
                    <li><a href='../gallery.php'>Galeria</a></li>
                    <li><a href='../p_areaPessoal.php'>Área Pessoal</a></li>
                    <li><a href='../logout/logout.php'>Terminar sessão</a></li>
                </ul>
            </div>
        </header>

        <div class="grid-container">
            <div class="grid-item">

                <form action="updateVideo.php" method="POST" enctype="multipart/form-data">
                    <br>
                    <label for="file">Escolha o video (. mp4) </label>
                    <input type="file" name='file'>
                    <input type="submit">
                </form>

            </div>

            <div class="grid-item">
                <h1>Adicionar video</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis ante est. Integer id viverra libero. Praesent non semper urna. Duis lobortis quis ipsum in faucibus. <br> Phasellus id enim posuere, congue diam at, accumsan purus. Nulla ultricies condimentum congue. <br> Maecenas sem ex, pulvinar at erat vel, lobortis ultrices justo. <br> Sed sit amet metus in libero laoreet finibus nec eu nisl.</p>
            </div>
        </div>

    </body>
</html>