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

                    $ativo = true;
                    $sql = "SELECT codArma, descricao FROM tipoarma WHERE ativo = '$ativo'";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($res);
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
                            <form action="addTipoEvento.php" method="POST">
                                <fieldset>
                                    <legend>Registar Tipo de Evento</legend>
                                    <input type="text" name="tipoevento" placeholder="Tipo de evento">
                        
                                    <input type="submit" value="Registar">
                                </fieldset>
                            </form>


                            <br>
                            <br>


                            <form action="addTipoArma.php">
                                <fieldset>
                                    <legend>Associar Arma a Tipo de Evento</legend>

                                    <label for="evento">Selecionar Tipo de Evento</label>
                                    <select name="evento">
                                        <option selected hidden>Escolher tipo de evento</option>

                                        <?php
                                            $sql_tipo_evento = "SELECT * FROM tipoevento WHERE ativo = '$ativo'";
                                            $res_tipo_evento = mysqli_query($conn, $sql_tipo_evento);

                                            while($row_tipo_evento = mysqli_fetch_array($res_tipo_evento))
                                            {
                                                echo"<option value='".$row_tipo_evento['codTipo']."'>".$row_tipo_evento['descricao']."</option>";
                                            }
                                        ?>

                                    </select>



                                    <label for='arma'>Arma a utilizar</label>
                                    <select name="arma">
                                        <option selected hidden>Escolher arma a utilizar</option>

                                        <?php
                                            $sql_tipo_arma = "SELECT * FROM tipoarma WHERE ativo = '$ativo'"; 
                                            $res_tipo_arma = mysqli_query($conn, $sql_tipo_arma);

                                            while($row_tipo_arma = mysqli_fetch_array($res_tipo_arma))
                                            {
                                                echo"<option value='".$row_tipo_arma['codArma']."'>".$row_tipo_arma['descricao']."</option>";
                                            } 
                                        ?>

                                    </select>

                                    <input type="submit" value="Registar">

                                </fieldset>                                
                            </form>
                        </div>

                        <div class="grid-item">
                            <h1>Novo Tipo de Evento</h1>
                            <p>O Administrador pode registar novos tipos de eventos na plataforma da Associação de Caça</p>
                            <p>Apenas devem ser feitos quando necessario.</p>
                        </div>
                    </div>

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