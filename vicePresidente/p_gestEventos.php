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

            include '../include/perfil.php';
            include '../database/basedados.h';

            date:date_default_timezone_set('GMT');
            $dataSistema = date('Y-m-d');
            
            if(isset($_SESSION['utilizador']))
            {
                $sql = "SELECT codPerfil FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
    
                
    
                if($row['codPerfil'] == VICE_PRESIDENTE || $row['codPerfil'] == PRESIDENTE)
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
                    $ativo = true;
                    $sql = "SELECT e.codEvento AS codEvento, e.descricao AS Evento, te.descricao AS Tipo_Evento, tan.especie AS Especie, l.morada AS Localizacao, ta.descricao AS Tipo_Arma, ta.especificacaoTiro AS Tipo_Tiro, ta.silenciador AS Silenciador, e.preco AS Preco, e.vaga AS N_Vagas, e.data AS Data, e.ativo AS ativo FROM evento AS e INNER JOIN tipoevento AS te ON (e.codTipo = te.codTipo) INNER JOIN armaevento AS ae ON (ae.codTipo = te.codTipo) INNER JOIN tipoanimal AS tan ON (e.codAnimal = tan.codAnimal) INNER JOIN localizacao AS l ON (e.codLocalizacao = l.codLocalizacao) INNER JOIN tipoarma as ta ON (ae.codArma = ta.codArma) ORDER BY e.data DESC";

                    $res = mysqli_query($conn, $sql);
                    

                    echo
                    "
                    <br>
                    <h1>Gestão de Eventos</h1>
                        <div class='content_table'>
                            <table width='100%'>
                                <thead>
                                    <tr>
                                        <th>
                                            <a href='p_addEvento.php'>➕ Novo Evento</a>
                                        </th>
                                        <th>Código Evento</th>
                                        <th>Evento</th>
                                        <th>Tipo de Evento</th>
                                        <th>Especie</th>
                                        <th>Localização</th>
                                        <th>Tipo de Arma</th>
                                        <th>Tipo de Tiro</th>
                                        <th>Moderador de Som</th>
                                        <th>Preço</th>
                                        <th>Nº Vagas</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                    ";
                    while($row = mysqli_fetch_array($res))
                    {
                        
                                echo
                                "
                                <tbody>";
                                    if($row['Data'] >= $dataSistema)
                                    {
                                        echo"
                                        <tr>";
                                            if($row['ativo'] == true)
                                            {  
                                                echo"
                                                <td>
                                                    <a href='desativarEvento.php?codEvento=".$row["codEvento"]."'>❌ Desativar</a>
                                                </td>";
                                            }
                                            else
                                            {
                                                echo"
                                                <td>
                                                    <a href='ativarEvento.php?codEvento=".$row["codEvento"]."'>✔️ Ativar</a>
                                                </td>";
                                            }
                                            echo
                                            "
                                            <td>".$row['codEvento']."</td>
                                            <td>".$row['Evento']."</td>
                                            <td>".$row['Tipo_Evento']."</td>
                                            <td>".$row['Especie']."</td>
                                            <td>".$row['Localizacao']."</td>
                                            <td>".$row['Tipo_Arma']."</td>
                                            <td>".$row['Tipo_Tiro']."</td>";

                                            if($row['Silenciador'] == 1)
                                            {
                                                echo"<td> Sim </td>";
                                            }
                                            else
                                            {
                                                echo"<td> Não </td>";    
                                            }
                                        
                                            echo
                                            "
                                            <td>".$row['Preco']."</td>
                                            <td>".$row['N_Vagas']."</td>
                                            <td>".$row['Data']."</td>
                                            <td><a href='p_editarEvento.php?codEvento=".$row["codEvento"]."'>✏️ Editar</a></td>
                                        </tr>";
                                    }
                                echo"
                                </tbody>
                                ";
                    }
                    echo
                    "
                            </table>

                            <div class='random-button'>
                                <form action='p_historicoEventos.php'>
                                    <button>Histórico de Eventos</button>
                                </form>
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