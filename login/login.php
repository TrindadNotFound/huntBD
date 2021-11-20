<?php
    session_start();

    include '../database/basedados.h';
    include '../include/perfil.php';

    if(isset($_POST["nomeUser"]) && isset($_POST["password"]))
    {
        $nomeUser = $_POST["nomeUser"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM utilizador WHERE nomeUser='$nomeUser' AND password= '".md5($password)."' AND codPerfil != ".DESATIVADO.";";
        $res = mysqli_query($conn, $sql);
 
        $row = mysqli_fetch_array($res);

        //Comparar se o conteudo da $row é igual à valiavel $username. O mesmo para a $password
        if(strcmp($row["nomeUser"], $nomeUser) == 0 && strcmp($row["password"], md5($password)) == 0)
        {
            $_SESSION["utilizador"] = $row["nomeUser"];
            $_SESSION["perfil"] = $row["codPerfil"];
            $_SESSION['nome'] = $row['nome'];
        }
        else
        {
            $_SESSION["utilizador"] = -1;
            $_SESSION["perfil"] = -1;
        }

        header("refresh:0; login_check.php");

    }
    else
    {
        session_destroy();
        header("refresh:0; ../index.php");
    }

?>