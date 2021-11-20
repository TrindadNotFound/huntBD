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
            include '../include/function.php';

            if(isset($_SESSION['utilizador']))
            {
                $sql = "SELECT codPerfil, codUtilizador FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
                $codUtilizador = $row['codUtilizador'];
    
                
    
                if($row['codPerfil'] == VICE_PRESIDENTE || $row['codPerfil'] == PRESIDENTE)
                {   
                    $presidente = 0; //Inicia a variavel a 0
                    if($row['codPerfil'] == PRESIDENTE)
                    {
                        $presidente = 1; //Variavel de controlo para saber o utilizador é o Presidentr ou não
                    }
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
                    
                    $sql = "SELECT DISTINCT u.codUtilizador, u.nome, u.apelido, tp.descricao AS tipoPerfil, tq.descricao FROM utilizador AS u INNER JOIN quota AS q ON (u.codUtilizador = q.codUtilizador) INNER JOIN tipoquota AS tq ON (q.tipoQuota = tq.codTipo) INNER JOIN tipoperfil AS tp ON (u.codPerfil = tp.codTipo)
                            WHERE u.codPerfil = 5 OR u.codPerfil = 4 OR u.codPerfil = 3 OR u.codPerfil = 2";
                    $res = mysqli_query($conn, $sql);
                    
                    echo
                    "
                    <br>
                    <br>
                    <h1>Gestão de Sócios</h1>
                        <div class='content_table'>
                            <table width='100%'>
                                <thead>
                                    <tr>";
                                        if($presidente == 1)
                                        {
                                            echo"
                                            <th>
                                                <a href='p_addSocio.php'> ➕ Novo Sócio</a>
                                                
                                            </th>";
                                        }
                                        echo"
                                        <th>Código Utilizador</th>
                                        <th>Nome</th>
                                        <th>Apelido</th>
                                        <th>Tipo de perfil</th>
                                        <th>Tipo de quota</th>
                                        <th>Dados pessoais</th>
                                        <th>Quotas</th>
                                    </tr>
                                </thead>
                    ";

                    while($row = mysqli_fetch_array($res))
                    {
                                
                            echo"<tbody>
                                    <tr>";
                                        if(($presidente == 1) && ($codUtilizador!=$row['codUtilizador']))
                                        {
                                            $ativo=false;
                                            $ver_user_ativo = $row['codUtilizador'];

                                            $sql_ver_ativo = "SELECT ativo FROM utilizador WHERE codUtilizador = '$ver_user_ativo'";
                                            $res_ver_ativo = mysqli_query($conn, $sql_ver_ativo);
                                            $row_ver_ativo = mysqli_fetch_array($res_ver_ativo);

                                            if($row_ver_ativo['ativo'] == $ativo)
                                            {
                                                echo"
                                                <td>
                                                    <a href='ativar.php?codUtilizador=".$row["codUtilizador"]."'> ✔️Ativar </a>
                                                </td>";
                                            }
                                            else
                                            {
                                                echo"
                                                <td>
                                                    <a href='desativar.php?codUtilizador=".$row["codUtilizador"]."'> ❌Desativar</a>
                                                </td>";
                                            }
                                            
                                           
                                        }
                                        else
                                        {
                                            echo"<td></td>";
                                        }
                                        echo"
                                        <td>".$row['codUtilizador']."</td>
                                        <td>".$row['nome']."</td>
                                        <td>".$row['apelido']."</td>
                                        <td>".$row['tipoPerfil']."</td>
                                        <td>".$row['descricao']."</td>

                                        <td>
                                            <a href='p_dadosSocios.php?codUtilizador=".$row["codUtilizador"]."'> 👓 Consultar</a>
                                        </td>
                                                
                                        <td>
                                            <a href='p_quotasSocio.php?codUtilizador=".$row["codUtilizador"]."'> 👓 Consultar</a>
                                        </td>
                                    </tr>
                                </tbody>";
                    }
                    echo"            
                            </table>
                        </div>
                    ";
                }
                else
                {
                    header('refresh:0; ../index.php');
                }
            }
            else
            {
                header('refresh:0; ../index.php');
            }  
        ?>
    </body>
</html>