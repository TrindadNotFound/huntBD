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
            include '../include/function.php';

            if(isset($_SESSION['utilizador']))
            {
                $sql = "SELECT codPerfil, codUtilizador FROM utilizador WHERE nomeUser = '".$_SESSION["utilizador"]."'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($res);
                
                $codUtilizador = $row['codUtilizador'];
                
    
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

                    $sql = "SELECT * FROM utilizador";
                    $res = mysqli_query($conn, $sql);
                    
                    echo
                    "
                    <br>
                    <br>
                    <h1>Gestão de utilizadores</h1>
                        <div class='content_table'>
                            <table width='100%'>
                                <thead>
                                    <tr>
                                        <th>
                                            <a href='p_addUtilizador.php'>➕ Novo Utilizador</a></td>
                                        </th>
                                        <th>Nome Utilizador</th>
                                        <th>Tipo de Utilizador</th>
                                        <th>Validar</th>
                                        <th>Editar</th>
                                        <th>Definir Presidente</th>
                                    </tr>
                                </thead>
                    ";

                    while($row = mysqli_fetch_array($res))
                    {
                                
                            echo"<tbody>
                                    <tr>";
                                        if($row['ativo']==true)
                                        {
                                            if($row['codUtilizador'] == $codUtilizador)
                                            {
                                                echo"<td></td>";
                                            }
                                            else
                                            {
                                                echo"
                                                <td>
                                                    <a href='desativar.php?codUtilizador=".$row["codUtilizador"]."'>❌ Desativar</a>
                                                </td>";
                                            }
                                        }
                                        else
                                        {
                                            echo"
                                            <td>
                                                <a href='ativar.php?codUtilizador=".$row["codUtilizador"]."'>✔️Ativar</a>
                                            </td>";
                                        }
                                        
                                        echo"
                                        <td>".$row['nomeUser']."</td>
                                        <td>".function_Perfil($row['codPerfil'])."</td>";

                                        //Se o UTILIZADOR estiver por validar
                                        if($row['codPerfil'] == POR_VALIDAR)
                                        {
                                            echo"
                                            <td>
                                                <a href='promover.php?nomeUser=".$row["nomeUser"]."'> ✔️ Validar</a>
                                            </td>";
                                        } //REDIRECIONA PARA A PÁGINA DE VALIDAR UTILIZADORES
                                        else
                                        {
                                            echo"<td></td>";
                                        }




                                        //Se o UTILIZADOR nao estiver eliminado
                                        if($row['codPerfil'] != DESATIVADO)
                                        {
                                            echo"
                                            <td>
                                                <a href='p_gestDados.php?nomeUser=".$row["nomeUser"]."'> ✏️ Editar </a>
                                            </td>";
                                        } //REDIRECIONA PARA  APÁGINA DE EDITAR DADOS DO UTILIZADORES
                                        else
                                        {
                                            echo"<td></td>";
                                        }



                                        
                                        //Se o UTILIZADOR não for ADMINISTRADOR
                                        if($row['codPerfil'] != ADMIN)
                                        {
                                            /*
                                            //O DESATIVADO pode ser promovido a POR_VALIDAR
                                            if($row['codPerfil'] == DESATIVADO)
                                            {
                                                echo"
                                                <td>
                                                    <a href='promover.php?nomeUser=".$row["nomeUser"]."'> 🎖️ </a>
                                                </td>";
                                            }
                                            //O POR_VALIDAR pode ser despromovido a DESATIVADO                            
                                            elseif($row['codPerfil'] == POR_VALIDAR)
                                            {
                                                echo"
                                                <td>
                                                    <a href='despromover.php?nomeUser=".$row["nomeUser"]."'> 👎 </a>
                                                    <a href='promover.php?nomeUser=".$row["nomeUser"]."'> 🎖️ </a>
                                                </td>";
                                            }
                                            //O SOCIO pode ser despromovido a POR_VALIDAR                            
                                            elseif($row['codPerfil'] == SOCIO)
                                            {
                                                echo"
                                                <td>
                                                    <a href='despromover.php?nomeUser=".$row["nomeUser"]."'> 👎 </a>
                                                    <a href='promover.php?nomeUser=".$row["nomeUser"]."'> 🎖️ </a>
                                                </td>";                                
                                            }

                                            elseif($row['codPerfil'] == SECRETARIO)
                                            {
                                                echo"
                                                <td>
                                                    <a href='despromover.php?nomeUser=".$row["nomeUser"]."'> 👎 </a>
                                                    <a href='promover.php?nomeUser=".$row["nomeUser"]."'> 🎖️ </a>
                                                </td>";                                
                                            }
                                            elseif
                                            */
                                            
                                            if($row['codPerfil'] == VICE_PRESIDENTE)
                                            {
                                                echo"
                                                <td>
                                                    <a href='promover.php?nomeUser=".$row["nomeUser"]."'> 🎖️ Definir Presidente</a>
                                                </td>";                                
                                            }
                                            /*
                                            elseif($row['codPerfil'] == PRESIDENTE)
                                            {
                                                echo"
                                                <td>
                                                    <a href='despromover.php?nomeUser=".$row["nomeUser"]."'> 👎 </a>
                                                </td>";                                
                                            }
                                            */

                                        }
                                        
                                echo"</tr>
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