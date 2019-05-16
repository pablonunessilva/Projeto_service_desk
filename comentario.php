<?php
    include "include/banco.php";
    var_dump($_POST, $_FILES);
    $idusuario = $_POST['idusuario'];
    $idchamado = $_POST['idchamado'];
    $resposta = $_POST['resposta'];
    $modal = $_POST['modal'];
    $data = date('d/m/Y');
    $hora = date('H:i:s');

    $nome_final = "";
    if(isset($_FILES) && !empty($_FILES['arquivo']['name'])){
      $_UP['pasta'] = 'uploads/';
      $nome_final = base64_encode($idchamado."_".$idusuario."_".$_FILES['arquivo']['name']);
      move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final);
    }
    
    $query = "INSERT INTO `helpdesk2`.`respostas` 
                (`resposta`, `idusuario`, `idchamado`, `data`, `hora`, `anexo`) 
              VALUES ('$resposta', '$idusuario', '$idchamado', '$data', '$hora', '$nome_final')";

    mysqli_query($con, $query);
    
    if ($modal == 'cliente') {
      header("Location: homeusuario.php?msagen=success");
    }
    else{
      header("Location: home.php?msagen=success");
    }
?>
