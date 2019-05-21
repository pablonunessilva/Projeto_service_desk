<?php 
// renomeie o nome "helpdesk2" para o nome que vc vai dar para o banco.

   
	$con =@ mysqli_connect("cobra.q4dev.com.br","admin","123456","helpdesk2") or die("<h3>Erro de conexão ao banco de dados, favor informar ao suporte técnico.</h3>");
	mysqli_set_charset($con,"utf_8");
 ?>