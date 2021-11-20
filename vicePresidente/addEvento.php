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
    <?php
            session_start();
            include '../database/basedados.h';

            $ativo = true;

            $sql = "SELECT MAX(codEvento) AS codEvento FROM evento";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($res);

            $codEvento = $row['codEvento'] + 1;


            $evento = $_POST['evento']; //Descrição do evento ('descricao' da tabela 'evento')
            $tipo_evento = $_POST['tipo_evento']; //Recebe o codTipoEvento
            $especie = $_POST['especie']; //Recebe o codEspecie
            $localizacao = $_POST['localizacao']; //Recebe o codLocalizacao

            $preco = $_POST['preco']; //Recebe um valor INT
            $n_vagas = $_POST['n_vagas']; //Recebe um valor INT
            $data = $_POST['data']; //Recebe um valor date



            $mancha = $_POST['mancha']; //Recebe um valor em varchar  UPDATE TABELA LOCALIZACAO

            /*
            $tipo_arma = $_POST['tipo_arma']; //Recebe o codArma UPDATE TABELA TIPOEVENTO
            $tipo_tiro = $_POST['tipo_tiro']; //Recebe um valor em varchar  UPDATE TABELA TIPOARMA
            if(isset($_POST['silenciador'])) //UPDATE TABELA TIPOARMA
            {
                $silenciador = true;
            }
            else
            {
                $silenciador = false;
            }*/


            $sql = "INSERT INTO evento (codEvento, codTipo, codAnimal, codLocalizacao, preco, vaga, vagaatual, data, descricao, ativo) VALUES ('$codEvento', '$tipo_evento', '$especie', '$localizacao', '$preco', '$n_vagas', '$n_vagas', '$data', '$evento', '$ativo')";
            $res = mysqli_query($conn, $sql);

            if(mysqli_affected_rows($conn)==1)
            {
                $_SESSION['title'] = "Sucesso!";
                $_SESSION['text'] = "Novo evento criado com sucesso";
                $_SESSION['icon'] = "success"; 
                $_SESSION['url'] = "../vicePresidente/p_gestEventos.php";
            }
            else
            {
                $_SESSION['title'] = "Ups";
                $_SESSION['text'] = "Não foi possivel registar o novo evento";
                $_SESSION['icon'] = "warning"; 
                $_SESSION['url'] = "../vicePresidente/p_gestEventos.php";
            }

            include '../include/script.php';
        ?>
    </body>
</html>