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

            include '../include/perfil.php';
            include '../database/basedados.h';

            if(isset($_SESSION['utilizador']))
            {
                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
    
                
    
                if($row['codPerfil'] == ADMIN)
                {
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
        <?php
                    $codtipo = $_GET['codtipo'];
                    $codArma = $_GET['codArma'];

                    $_SESSION['codtipo'] = $codtipo;
                    $_SESSION['codArma'] = $codArma;

                    $sql = "SELECT descricao FROM tipoevento WHERE codTipo = '$codtipo'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);

                    $descTipoEvento = $row['descricao'];

                    $sql_2 = "SELECT descricao FROM tipoarma WHERE codArma = '$codArma'";
                    $res_2 = mysqli_query($conn, $sql_2);
                    $row_2 = mysqli_fetch_array($res_2);

                    $descTipoArma = $row_2['descricao'];
                    
                    echo
                    "
                    <div class='grid-container'>
                        <div class='grid-item'>
                            <form action='updateTipoEvento.php' method='POST'>
                                <label for='tipoevento'>Tipo de Evento </label>
                                <input type='text' name='tipoevento' value='".$descTipoEvento."'>
                                <br>

                                <label for='arma'>Tipo de Arma</label>
                                <select name='arma'>
                                    <option selected hidden>".$descTipoArma."</option>";

                                    $ativo=true;
                                    $sql_tipo_arma = "SELECT * FROM tipoarma WHERE ativo = '$ativo'"; 
                                    $res_tipo_arma = mysqli_query($conn, $sql_tipo_arma);

                                    while($row_tipo_arma = mysqli_fetch_array($res_tipo_arma))
                                    {
                                        echo"<option value='".$row_tipo_arma['codArma']."'>".$row_tipo_arma['descricao']."</option>";
                                    } 

                                echo
                                "</select>
                
                                <input type='submit' value='Alterar'>
                            </form>
                        </div>

                        <div class='grid-item'>
                            <h1>Editar armamento</h1>
                            <p>O Administrador pode fazer as alterações necessarias nas informações referentes a um determinado tipo de evento que esteja registado na plataforma da Associação de Caça</p>
                            <p>As alterações devem ser feitas com responsabilidade</p>
                        </div>
                    </div>
                    ";
        ?>
        <?php
                }
            }
            else
            {
                header('refresh:0; ../index.php');
            }


        ?>
        
    </body>
</html>