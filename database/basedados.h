<?php
	define("USER_BD","root");
	define("PASS_BD","");
	define("NOME_BD","huntbd");

	$hostname_conn = "localhost";
	
	//Fazer ligação com o servidor MySQL
	if(!($conn = mysqli_connect($hostname_conn, USER_BD, PASS_BD))) 
	{
	   echo "Não foi possivel ligar ao servidor MySQL.";
	   exit;
	}

	//Depois de ligar ao servidor, seleciona a base de dados
	if(!($con = mysqli_select_db($conn, NOME_BD))) 
	{
	   echo "Não foi possivel ligar à base de dados selecionada";
	   exit;
	}

?>