<?php
    include "include/banco.php";
    
    $idchamado = $_POST['idchamado'];
    $prioridade = $_POST['prioridade'];
    
    $query = "update chamados set id_prioridade = '$prioridade' where idchamado = '$idchamado'";
    var_dump($query);
    $insert = mysqli_query($con, $query);
    
    if($insert == true){
       header("Location: homeusuario.php?msagen=left");
    }else{
        var_dump($insert);
    }
    
?>