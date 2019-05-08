<?php
    include "include/banco.php";
    $idusuario = $_POST['idusuario'];
    $idchamado = $_POST['idchamado'];
    $resposta = $_POST['resposta'];
    $modal = $_POST['modal'];
    $data = date('d/m/Y');
    $hora = date('H:i:s');
    
    $query = "INSERT INTO `helpdesk2`.`respostas` 
                (`resposta`, `idusuario`, `idchamado`, `data`, `hora`) 
              VALUES ('$resposta', '$idusuario', '$idchamado', '$data', '$hora')";
    mysqli_query($con, $query);
    
    if ($modal == 'cliente') {
      header("Location: homeusuario.php?msagen=success");
    }
    else{
      header("Location: home.php?msagen=success");
    }
?> 