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

            if(isset($_SESSION['utilizador']))
            {

                
                $ativo = true;


                $codEvento = $_SESSION['codEvento'];
                $evento = $_POST['evento']; //Descrição do evento ('descricao' da tabela 'evento')
                $tipo_evento = $_POST['tipo_evento']; //Recebe o codTipoEvento
                $especie = $_POST['especie']; //Recebe o codEspecie
                $localizacao = $_POST['localizacao']; //Recebe o codLocalizacao
                $preco = $_POST['preco']; //Recebe um valor INT
                $n_vagas = $_POST['n_vagas']; //Recebe um valor INT
                $data = $_POST['data']; //Recebe um valor date



                $mancha = $_POST['mancha']; //Recebe um valor em varchar  UPDATE TABELA LOCALIZACAO

                $tipo_arma = $_POST['tipo_arma']; //Recebe o codArma UPDATE TABELA TIPOEVENTO
                $tipo_tiro = $_POST['tipo_tiro']; //Recebe um valor em varchar  UPDATE TABELA TIPOARMA
                if(isset($_POST['silenciador'])) //UPDATE TABELA TIPOARMA
                {
                    $silenciador = true;
                }
                else
                {
                    $silenciador = false;
                }


                
                //if((!empty($evento)) || (!empty($tipo_evento)) || (!empty($especie)) || (!empty($localizacao)) || (!empty($mancha)) || (!empty($tipo_arma)) || (!empty($tipo_tiro)) || (!empty($silenciador)) || (!empty($preco)) || (!empty($n_vagas)) || (!empty($data)))
                if((!empty($evento)) && (!empty($tipo_evento)) && (!empty($especie)) && (!empty($localizacao)) && (!empty($mancha)) && (!empty($tipo_arma)) && (!empty($tipo_tiro)) && (!empty($silenciador)) && (!empty($preco)) && (!empty($n_vagas)) && (!empty($data)))
                {
                    $controlo = 0;


                    $sql = "UPDATE tipoevento SET codArma='$tipo_arma' WHERE codTipo='$tipo_evento'";
                    $res = mysqli_query($conn, $sql);
                   

                     $sql = "UPDATE localizacao SET mancha = '$mancha' WHERE codLocalizacao = '$localizacao'";
                    $res = mysqli_query($conn, $sql);
                    
                    
                    $sql = "UPDATE tipoarma SET especificacaoTiro = '$tipo_tiro', silenciador = '$silenciador' WHERE codArma = '$tipo_arma'";
                    $res = mysqli_query($conn, $sql);
                    

                    $sql = "UPDATE evento SET codTipo='$tipo_evento', codAnimal='$especie', codLocalizacao='$localizacao', preco='$preco', vaga='$n_vagas', data='$data', descricao='$evento' WHERE codEvento='$codEvento'";
                    $res = mysqli_query($conn, $sql);
                    
                    
                    $_SESSION['title'] = "Sucesso";
                    $_SESSION['text'] = "Evento editado com sucesso";
                    $_SESSION['icon'] = "success"; 
                    $_SESSION['url'] = "../admin/p_gestEventos.php";
                    
                }
                else
                {
                    $_SESSION['title'] = "Ups";
                    $_SESSION['text'] = "Os campos devem ser preenchidos corretamente";
                    $_SESSION['icon'] = "error"; 
                    $_SESSION['url'] = "../admin/p_gestEventos.php";
                } 
                
            }

            include '../include/script.php';
        ?>
    </body>
</html>