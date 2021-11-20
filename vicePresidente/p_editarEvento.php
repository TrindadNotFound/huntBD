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
                $nomeUser = $_SESSION['utilizador'];
            
                $sql = "SELECT * FROM utilizador WHERE nomeUser='$nomeUser'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
                

                if($row['codPerfil'] == VICE_PRESIDENTE || $row['codPerfil'] == PRESIDENTE)
                {
        ?>
                    <header>
                        <div class='navbar'>
                            <h1>Associação de caça</h1>
                            <ul>
                                <li><a href='../index.php'>Inicio</a></li>
                                <!--<li><a href='#'>Ser sócio</a></li>-->
                                <li><a href='../about.php'>Quem somos</a></li>
                                <li><a href='../gallery.php'>Galeria</a></li>
                                <li><a href='../p_areaPessoal.php'>Area Pessoal</a></li>
                                <li><a href='../logout/logout.php'>Terminar sessão</a></li>
                            </ul>
                        </div>
                    </header>
                    
        <?php
                    $codEvento = $_GET['codEvento'];
                    $_SESSION['codEvento'] = $codEvento;//Passa o codEvento para a página "updateEvento.php"
                    $ativo = true;
                    $sql = "SELECT e.codEvento AS codEvento, e.descricao AS Evento, te.descricao AS Tipo_Evento, 
                            tan.especie AS Especie, l.morada AS Localizacao, l.mancha AS Mancha, ta.descricao AS Tipo_Arma, 
                            ta.especificacaoTiro AS Tipo_Tiro, ta.silenciador AS Silenciador, e.preco AS Preco,
                            e.vaga AS N_Vagas, e.data AS Data FROM evento AS e 

                            INNER JOIN tipoevento AS te ON (e.codTipo = te.codTipo) 
                            INNER JOIN tipoanimal AS tan ON (e.codAnimal = tan.codAnimal) 
                            INNER JOIN localizacao AS l ON (e.codLocalizacao = l.codLocalizacao) 
                            INNER JOIN tipoarma as ta ON (te.codArma = ta.codArma) 

                            WHERE e.codEvento = '$codEvento'";

                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);


                    echo
                    "
                    <div class='grid-container'>
                        <div class='grid-item'>
                            <form action='updateEvento.php' method='POST'>
                                <label for='evento'>Evento</label>
                                <input type='text' name='evento' value='".$row['Evento']."' placeholder='".$row['Evento']."'>

                                <label for='tipo_evento'>Tipo Evento</label>
                                <select name='tipo_evento'>
                                    <option selected hidden>".$row['Tipo_Evento']."</option>";

                                    $sql_tipo_evento = "SELECT * FROM tipoevento WHERE ativo = '$ativo'"; //Para saber toda a informação que esta na tabela "tipoevento"
                                    $res_tipo_evento = mysqli_query($conn, $sql_tipo_evento);

                                    while($row_tipo_evento = mysqli_fetch_array($res_tipo_evento))
                                    {
                                        echo"<option value='".$row_tipo_evento['codTipo']."'>".$row_tipo_evento['descricao']."</option>";
                                    } 
    
                                echo
                                "</select>

                                <br>

                                <label for='especie'>Especie</label>
                                <select name='especie'>
                                    <option selected hidden>".$row['Especie']."</option>";

                                    $sql_tipo_animal = "SELECT * FROM tipoanimal WHERE ativo = '$ativo'"; //Para saber toda a informação que esta na tabela "tipoanimal"
                                    $res_tipo_animal = mysqli_query($conn, $sql_tipo_animal);

                                    while($row_tipo_animal = mysqli_fetch_array($res_tipo_animal))
                                    {
                                        echo"<option value='".$row_tipo_animal['codAnimal']."'>".$row_tipo_animal['especie']."</option>";
                                    } 
    
                                echo
                                "</select>


                                <label for='localizacao'>Localização</label>
                                <select name='localizacao'>
                                    <option selected hidden>".$row['Localizacao']."</option>";

                                    $sql_localizacao = "SELECT * FROM localizacao WHERE ativo = '$ativo'"; //Para saber toda a informação que esta na tabela "tipoanimal"
                                    $res_localizacao = mysqli_query($conn, $sql_localizacao);

                                    while($row_localizacao = mysqli_fetch_array($res_localizacao))
                                    {
                                        echo"<option value='".$row_localizacao['codLocalizacao']."'>".$row_localizacao['morada']."</option>";
                                    } 

                                echo
                                "</select>
                                
                                <br>

                                <label for='mancha'>Mancha</label>
                                <input type='text' name='mancha' value='".$row['Mancha']."'>




                                <label for='tipo_arma'>Tipo Arma</label>
                                <select name='tipo_arma'>
                                    <option selected hidden>".$row['Tipo_Arma']."</option>";

                                    $sql_tipo_arma = "SELECT * FROM tipoarma WHERE ativo = '$ativo'"; //Para saber toda a informação que esta na tabela "tipoanimal"
                                    $res_tipo_arma = mysqli_query($conn, $sql_tipo_arma);

                                    while($row_tipo_arma = mysqli_fetch_array($res_tipo_arma))
                                    {
                                        echo"<option value='".$row_tipo_arma['codArma']."'>".$row_tipo_arma['descricao']."</option>";
                                    } 

                                echo
                                "</select>

                                <br>

                                <label for='tipo_tiro'>Tipo Tiro</label>
                                <input type='text' name='tipo_tiro' value='".$row['Tipo_Tiro']."'> 

                                <label for='silenciador'>Silenciador</label>";
                                if($row['Silenciador'] == 1 )
                                {
                                    echo"<input type='checkbox' name='silenciador' value='1' checked='checked'>
                                    <br>";
                                }
                                else
                                {
                                    echo"<input type='checkbox' name='silenciador' value='0'>
                                    <br>";

                                }
                                

                               echo"
                                <label for='preco'>Preco</label>
                                <input type='text' name='preco' value='".$row['Preco']." €'>

                                <label for='n_vagas'>Vagas</label>
                                <input type='text' name='n_vagas' value='".$row['N_Vagas']."'>

                                <br>

                                <label for='data'>Data</label>
                                <input type='date' name='data' value='".$row['Data']."'>

                                <input type='submit' value='Alterar'>
                            </form>
                        </div>

                        <div class='grid-item'>
                            <h1>Editar Evento</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quis ante est. Integer id viverra libero. Praesent non semper urna. Duis lobortis quis ipsum in faucibus. Phasellus id enim posuere, congue diam at, accumsan purus. Nulla ultricies condimentum congue. Maecenas sem ex, pulvinar at erat vel, lobortis ultrices justo. Sed sit amet metus in libero laoreet finibus nec eu nisl.</p>
                            <p>Suspendisse semper felis ut consequat pharetra. Ut nec hendrerit nunc. Phasellus ut tellus nibh. Suspendisse eget justo mi. Nunc tempus magna vel porta viverra. Vestibulum tempus velit sit amet mattis fermentum. Sed nec imperdiet justo, vitae iaculis diam. Vestibulum metus ante, fermentum in leo at, finibus venenatis massa. Proin porta scelerisque lectus in iaculis. Maecenas sed sem neque. Pellentesque quis sem eget quam rutrum pulvinar et ut nisi. Curabitur tincidunt quam a lacus convallis rhoncus. Suspendisse mi nisi, condimentum eu commodo quis, venenatis efficitur metus. Integer feugiat pharetra nisl ac lacinia. Aenean lacinia odio non semper finibus. Praesent nunc metus, dictum non mattis quis, viverra sed purus.</p>
                        </div>
                    </div>
                    ";


                }
            }
            else
            {
                header('refresh:0; ../index.php');
            }
        ?>
    </body>
</html>