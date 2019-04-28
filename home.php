<?php

//essa pagina é somente do admin.
    include "include/banco.php";

    if(empty($_COOKIE['admin'])){ 
      header("Location:index.php"); 
    }
    if(isset($_COOKIE['usuario'])){
      header("Location:homeusuario.php");
    }
    if(isset($_COOKIE['tecnico'])){
        header("Location:hometech.php");
    }

    //Mensagem de Sucesso 
    if(isset($_GET['msagen'])){
        $msagen = $_GET['msagen'];
        if($msagen == "success"){
            echo "<script>alert('Resposta postada com sucesso!');</script>";       
        }
    }

// essa variavel serve para já começar com conteudo para não dar erro! 
    $status = "Pendente";
    $id = isset($_COOKIE['idusuario']) ? $_COOKIE['idusuario'] : '';

    if(isset($_POST['selecionar'])){
        $selecionar = $_POST['selecionar'];
        $status = $_POST['status'];
        
        if($selecionar == "todos"){
            $query = "select A.idchamado, A.data, A.setorcall, A.solicitacao, A.descricao, B.desc_problema, A.status,C.prioridade_desc,C.sla from chamados as A  LEFT JOIN tbl_problema as B ON A.id_problema = B.id_problema LEFT JOIN prioridade as C ON A.id_prioridade =C.id  where status = '$status' order by idchamado";
        }else{
            $query="select A.idchamado, A.data, A.setorcall, A.solicitacao, A.descricao, B.desc_problema, A.status,C.prioridade_desc,C.sla from chamados as A  LEFT JOIN tbl_problema as B ON A.id_problema = B.id_problema LEFT JOIN prioridade as C ON A.id_prioridade =C.id  where status = '$status' and setorcall='$selecionar' order by idchamado";
        }
        
    }else{ $query = "select A.idchamado, A.data, A.setorcall, A.solicitacao, A.descricao, B.desc_problema, A.status,C.prioridade_desc,C.sla from chamados as A  LEFT JOIN tbl_problema as B ON A.id_problema = B.id_problema LEFT JOIN prioridade as C ON A.id_prioridade =C.id  where status = 'Pendente' order by idchamado"; }
    $cons = mysqli_query($con, $query);
    $total = mysqli_num_rows($cons);

    include "include/header.php";   
?>
<div class="clear4"></div>
    <section class="overx" >
        <div class="container">
        
                <h3 class="ajust2">Chamados</h3>
              
                <form action="" method="post" >
                <div class="row">
                    <div class="form-group col-md-4">
                        <label style="color: black;" for="selecionar">Selecionar por:</label>
                        <select class="form-control" name="selecionar" id="selecionar" required>
                               <option value="" readonly>Selecione:</option>
                               <option value="helpdesk">Técnico Help Desk</option>
                               <option value="administrativo">Administrativo</option>
                               <option value="admin_no_privilege">Administrativo(Sem Privilégios)</option>
                               <option value="tecnicoInformatica">Tecnico Informática</option>
                               <option value="cliente">Cliente</option>
                            
                        </select>
                        
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label style="color: black;" for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="" readonly>Selecione:</option>
                            <option  style="color: red;" value="Pendente">Pendentes</option>
                            <option style="color: blue;" value="Resolvido">Resolvidos</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary"> Pesquisar</button>
                    </div>
                </div>
                </form>
                <div class="col-xs-12">
                <div class='table-responsive '>
                    <?php if($total != 0){
                        echo "<table class='table table-hover'>
                                <thead>
                                    <tr class='back'>
                                        <th>Setor</th>
                                        <th>Quem solicitou</th>
                                        <th>Problema</th>
                                        <th>Descrição do Problema</th>
                                        <th>Data da solicitação</th>
                                        <th>Status</th>
                                        <th>Prioridade</th>
                                        <th>Prazo</th>
                                        <th>Visualizar solicitacao:</th>
                                        <th>Atualizar situação</th>
                                    </tr>
                                </thead>";

                        while($quero = mysqli_fetch_array($cons)){
                            $idchamado = $quero['idchamado'];
                            echo "<tbody>   
                                    <tr>
                                        <td>" .$quero['setorcall']. "</td>
                                        <td>".$quero['solicitacao']."</td>
                                        <td>".$quero['desc_problema']."</td>
                                        <td>".$quero['descricao']."</td>
                                        <td>" .date("d-m-Y H:i:s",strtotime($quero['data'])). "</td>
                                        <td>" .$quero['status']. "</td>
                                        <td>" .$quero['prioridade_desc']. "</td>
                                        <td>" .date("d-m-Y H:i:s",strtotime($quero['data']." +".$quero['sla']."hour")). "</td>
                                        <td>" ?>
                                        
                            <?php if($quero['status'] == 'Pendente'){
                                $query4 = "select * from confirma where idchamado2 = $idchamado";
                                $consulta4 = mysqli_query($con,$query4);
                                $rows = mysqli_num_rows($consulta4);
                            
                                if ($rows > 0) {
                                    echo "<p style='color: red; '>".$quero['status']."</br><span style='font-style: italic;'>(Alteração</span></br>solicitada)</p>";
                                } else {
                                    echo "<span style='color: red;'>".$quero['status']."</span>";
                                ?>
                                    <a style="cursor: pointer;" data-toggle="modal"  data-target="#janela<?php echo "$idchamado"; ?>"><img  style="display: inline; height: 20px; width: 20px;" src="img/refresh.png"></a>
                                <?php 
                                    include 'include/modalalterarstatus.php';
                                } }
                            
                            if($quero['status'] == 'Resolvido') {
                                echo "<span style='color:blue;'>Resolvido</span>"; 
                            }
                            
                            ?><?php echo "</td>";  ?>
                            <?php
                                echo"<td>";?>
                                <a title="Visualizar detalhes" style="cursor: pointer;" data-toggle="modal"  data-target="#janela<?php echo "$idchamado"; ?>"><img width="50px" height="50px" src="img/descricao.jpg"/></a>
                            <?php
                                include 'include/modaldescricao.php';
                                echo "</td>
                                    </tr> 
                                </tbody>"; ?>   
                            <?php     
                            }
        
                            echo "</table>";

                    }
                    else{
                        echo '<div class="alert alert-warning" role="alert">
                                    <span>Nenhum registro encontrado</span>
                              </div>';
                    }
                    
                    ?>
                    
                </div> 
            </div>
        </div>
    </section>
<div class="clear3"></div>

<?php
    include "include/footer.php";
?>