<?php
include "include/banco.php";

$file_info = new SplFileInfo($_FILES['xml']['name']);

// Valida extensão
if ($file_info->getExtension() != 'xml'){
    header('Location: importar.php?mensagem=Inválido');
}
$usuario = $_COOKIE['idusuario'];
$setor = $_COOKIE['setor'];

$xmlstring = file_get_contents($_FILES['xml']['tmp_name']);

$xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$incidentes = json_decode($json, TRUE);

foreach ($incidentes as $num => $incidente) {
    $id                     = array_key_exists('id', $incidente)            ? $incidente['id']          : '';
    $atendente              = array_key_exists('atendente', $incidente)     ? $incidente['atendente']   : '';
    $solicitante            = array_key_exists('solicitante', $incidente)   ? $incidente['solicitante'] : '';
    $descricao              = array_key_exists('descricao', $incidente)     ? $incidente['descricao']   : '';
    $abertura               = array_key_exists('abertura', $incidente)      ? $incidente['abertura']    : '';
    $fechamento             = array_key_exists('fechamento', $incidente)    ? $incidente['fechamento']  : '';
    $status                 = array_key_exists('status', $incidente)        ? $incidente['status']      : '';
    $prioridade             = array_key_exists('prioridade', $incidente)    ? $incidente['prioridade']  : '';
    $categoria              = array_key_exists('categoria', $incidente)     ? $incidente['categoria']   : '';
    $tempo                  = array_key_exists('tempo-decorrido', $incidente)         ? $incidente['tempo-decorrido']       : '';

    // formata datas
    $abertura = date('Y-m-d H:i:s', strtotime($abertura));
    $fechamento = date('Y-m-d H:i:s', strtotime($fechamento));

    // Salva chamado
    $SQL = "insert into chamados (
                    idusuario, 
                    data, 
                    setorcall, 
                    solicitacao, 
                    descricao, 
                    id_problema, 
                    status,
                    id_prioridade) 
                values (
                    '$usuario',
                    '$abertura',
                    '$setor',
                    '$solicitante',
                    '$descricao',
                    '1',
                    'Pendente',
                    '$prioridade')";
    if (!mysqli_query($con, $SQL)){
        header("Location:home.php?msagen=ERRO" .mysqli_error($con));
    }
}
mysqli_close($con);

header("Location:home.php?msagen=right");