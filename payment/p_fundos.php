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
            $sql = "SELECT * FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($res);

            $codUtilizador = $row['codUtilizador'];
            $codCarteira = $row['codCarteira'];

            if($row['codPerfil']!=DESATIVADO && $row['codPerfil']!=POR_VALIDAR)
            {

                $sql = "SELECT saldo FROM carteira WHERE codCarteira = '$codCarteira'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);

                $saldo = $row['saldo'];
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

                <div class="grid-container">
                    <div class="grid-item">
                        <fieldset>
                            <legend>A minha carteira digital</legend>
                            <label for="saldo">O seu saldo é de : </label>
                            <input type="text" name="saldo" value= <?php echo" '$saldo €' "; ?>  disabled>
                        </fieldset>

                        <br>
                        <br>
                        <br>

                        <form action="addFundos.php" method="POST">
                            <fieldset>
                                <legend>Selecionar montante</legend>

                                <select name="montante">
                                    <option value="1">1€</option>
                                    <option value="5">5€</option>
                                    <option value="10">10€</option>
                                    <option value="50">50€</option>
                                </select>

                                <input type="submit" value="Adicionar fundos">
                            </fieldset>
                        </form>

                    </div>

                    <div class="grid-item">
                        <h1>Adicionar fundos</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis ante est. Integer id viverra libero. Praesent non semper urna. Duis lobortis quis ipsum in faucibus. <br> Phasellus id enim posuere, congue diam at, accumsan purus. Nulla ultricies condimentum congue. <br> Maecenas sem ex, pulvinar at erat vel, lobortis ultrices justo. <br> Sed sit amet metus in libero laoreet finibus nec eu nisl.</p>
                    </div>
                </div>
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