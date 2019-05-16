<?php
include "include/banco.php";

$query = "select idusuario, 
data, 
setorcall, 
solicitacao, 
descricao, 
id_problema, 
status,
data_resolvido,
id_prioridade from chamados";

$file = "chamados.xml";
$manipulador_arq = fopen($file,"w+");

fwrite($manipulador_arq,"<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n\n\n<helpdesk>");

$consulta = mysqli_query($con, $query);

while ($informacoes = mysqli_fetch_assoc($consulta)){
    $xml = "\n\n<incidente>\n";
    $xml .= "<atendente>1</atendente>\n";
    $xml .= "<solicitante>".$informacoes['idusuario']."</solicitante>\n";
    $xml .= "<descricao>".$informacoes['descricao']."</descricao>\n";
    $xml .= "<abertura>".$informacoes['data']."</abertura>\n";
    $xml .= "<fechamento>".$informacoes['data_resolvido']."</fechamento>\n";
    $xml .= "<status>".$informacoes['status']."</status>\n";
    $xml .= "<prioridade>".$informacoes['id_prioridade']."</prioridade>\n";
    $xml .= "<categoria atualizacao=".$informacoes['data_resolvido'].">".$informacoes['id_prioridade']."</categoria>\n";
    $xml .= "<tempo-decorrido>10</tempo-decorrido>\n";
    $xml .= "</incidente>\n";

    fwrite($manipulador_arq,$xml);
}

fwrite($manipulador_arq,"\n\n</helpdesk>"); 

header("content-type: text/html; charset=iso-8859-1");
header('Content-Type: application/octet-stream');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$file.'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
flush(); // Flush system output buffer
readfile($file);
exit;

fclose($manipulador_arq);

mysqli_close($con);

header("Location:home.php?msagen=right");
