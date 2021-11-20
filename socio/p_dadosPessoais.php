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
            echo
            "
            <header>
                <div class='navbar'>
                    <h1>Associação de caça</h1>
                    <ul>
                        <li><a href='../index.php'>Inicio</a></li>
                        <!--<li><a href='#'>Ser sócio</a></li>-->
                        <li><a href='../about.php'>Quem somos</a></li>
                        <li><a href='../gallery.php'>Galeria</a></li>
                        <li><a href='../p_areaPessoal.php'>Área Pessoal</a></li>
                        <li><a href='../logout/logout.php'>Terminar sessão</a></li>
                    </ul>
                </div>
            </header>
            ";


            $sql = "SELECT * FROM utilizador WHERE nomeUser= '".$_SESSION["utilizador"]."'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($res);

            
            echo
            "
            <div class='grid-container'>
                <div class='grid-item'>
                    <form action='updateDados.php' method='POST'>
                        
                        <input type='text' name='nome' placeholder='Nome' value='".$row['nome']."'>
                        <input type='text' name='apelido' placeholder='Apelido' value='".$row['apelido']."'>
                        <input type='date' name='dataNascimento' placeholder='Data nascimento' value='".$row['dataNascimento']."'>
                        <br>
                        <input type='text' name='morada' placeholder='Morada' value='".$row['morada']."'>
                        <input type='text' name='telemovel' placeholder='Telefone' value='".$row['telemovel']."'>
                        <input type='text' name='email' placeholder='Email' value='".$row['email']."'>
                        <br>
                        <input type='text' name='nif' placeholder='NIF' value='".$row['nif']."'>
                        <input type='text' name='limitacao' placeholder='Limitações fisicas' value='".$row['limitacao']."'>
                        <input type='text' name='restricaoAlimentar' placeholder='Restrições alimentares' value='".$row['restricaoAlimentar']."'>
                        <br>

                        <input type='text' name='numPorteArma' placeholder='Nº licença porte arma' value='".$row['numPorteArma']."'>
                        <input type='text' name='numApoliceSeguro' placeholder='Nº apólice de seguro' value='".$row['numApoliceSeguro']."'>
                        <input type='text' name='numLicencaCaca' placeholder='Nº licença de caça' value='".$row['numLicencaCaca']."'>
                        <br>
                        <input type='text' name='nomeUser' placeholder='Nome de utilizador' value='".$row['nomeUser']."' disabled>
                        <input type='password' name='pw' placeholder='Palavra-passe'>
                        <input type='password' name='pw2' placeholder='Confirmar Palavra-passe'>
                        <br>
                        <input type='submit' value='Alterar'>
                    </form>
                </div>
            ";
        }
    ?>

        <div class="grid-item">
            <h1>Dados Pessoais</h1>
            <p>Sempre que for necessario, pode alterar os seus dados pessoais.</p>
        </div>

    </div>

</body>
</html>