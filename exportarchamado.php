<?php
include "include/banco.php";

//function defination to convert array to xml
function array_to_xml($array, &$xml) 
{
    foreach($array as $key => $value) 
    {
        if(is_array($value)) 
        {
            if(!is_numeric($key))
            {
                $subnode = $xml->addChild("$key");
                array_to_xml($value, $subnode);
            }
            else
            {
                $subnode = $xml->addChild("$key");
                array_to_xml($value, $subnode);
            }
        }
        else 
        {
            $xml->addChild("$key",htmlspecialchars("$value"));
        }
    }
}

// Recupera o id do chamado
$idchamado = array_key_exists("idchamado", $_GET) ? $_GET['idchamado'] : false;

// Se não for informado id retorna com mensagem de erro
if (!$idchamado)
    header("Location:home.php?msagen=fail");

// Inicializa o array para receber os dados do chamado
$dados_chamado = array();

//creating object of SimpleXMLElement
$conteudo_xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\"?><helpdesk></helpdesk>");

$query = "select idusuario, 
            data, 
            setorcall, 
            solicitacao, 
            descricao, 
            id_problema, 
            status,
            data_resolvido,
            id_prioridade 
        from chamados
        where idchamado=$idchamado";

// Realiza a consulta no bd
$consulta = mysqli_query($con, $query);

// Obtem os dados da consulta atribuindo ao array dados
while ($informacoes = mysqli_fetch_assoc($consulta))
{
    $dados_chamado = array(
        'incidente' => array(
            "atendente"             => "1",
            "solicitante"           => $informacoes['idusuario'],
            "descricao"             => $informacoes['descricao'],
            "abertura"              => $informacoes['data'],
            "fechamento"            => $informacoes['data_resolvido'],
            "status"                => $informacoes['status'],
            "prioridade"            => $informacoes['id_prioridade'],
            "categoriaatualizacao"  => $informacoes['id_prioridade'],
            "tempodecorrido"        => "10",
        )
    );
}

//function call to convert array to xml
array_to_xml($dados_chamado, $conteudo_xml);

$dom = dom_import_simplexml($conteudo_xml)->ownerDocument;
$dom->formatOutput = true;

$full_path = "chamado_".$idchamado."_".time().".xml";

if ($dom->save($full_path)) 
{
    header("content-type: text/html; charset=iso-8859-1");
    header('Content-Type: application/octet-stream');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.$full_path.'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($full_path));
    flush(); // Flush system output buffer
    readfile($full_path);
    exit;

    header("Location:home.php?msagen=right");
}
else 
{
    header("Location:home.php?msagen=fail");
}
