<?php 
    $down='';
    if(isset($_COOKIE['admin'])){
        if(isset($_GET['msagen']) == "resolvido"){
            header("Location: support.php?msagen=up");
        }else if(isset($_GET['msagen']) == "right"){
            header("Location:support.php?msagen=right");
        }
    }else if(empty($_COOKIE['usuario'])){
        header("Location:index.php");
    }
    include "include/banco.php";

    $login = isset($_COOKIE['usuario']) ? $_COOKIE['usuario'] : '';
    $query = "select idusuario, setor, primeira_vez from usuario where login = '$login' limit 1";
    $consulta = mysqli_query($con, $query);
    if($usuario = mysqli_fetch_assoc($consulta)){
        $id = $usuario['idusuario'];
        $vez = $usuario['primeira_vez'];
    }
    if($usuario['setor'] == 'cliente'){
        $query2 = "select A.idchamado, A.data, A.setorcall, A.solicitacao, A.descricao, B.desc_problema, A.status,C.prioridade_desc,C.sla from chamados as A  LEFT JOIN tbl_problema as B ON A.id_problema = B.id_problema LEFT JOIN prioridade as C ON A.id_prioridade =C.id where idusuario = '$id'";
    }else{
        $query2 = "select A.idchamado, A.data, A.setorcall, A.solicitacao, A.descricao, B.desc_problema, A.status,C.prioridade_desc,C.sla from chamados as A  LEFT JOIN tbl_problema as B ON A.id_problema = B.id_problema LEFT JOIN prioridade as C ON A.id_prioridade =C.id order by A.data DESC";
 
    }
    $cons = mysqli_query($con, $query2);
    $total = mysqli_num_rows($cons);
    
    include "include/header.php";

//Mensagem de Sucesso 
    if(isset($_GET['msagen'])){
        $msagen = $_GET['msagen'];
        $down = "down2";
        
        if($msagen == "right"){
            echo "<script>alert('Problema relatado com Sucesso!');</script>";    
        }else if($msagen == "left"){
            echo "<script>alert('Senha alterada com sucesso! Obs: use esta senha para acessar a plataforma.');</script>";       
        }else if($msagen == "success"){
            echo "<script>alert('Resposta postada com sucesso!');</script>";
        }
    }
?>

	<section >
        <div onload="abrir" class="container <?php echo "$down"; ?> down ">
            <div class="col-xs-12 col-md-12">
                <br>
                <h3 class="ajust">Listar chamado(s)</h3>
                <br>
                <?php
                    if($total != 0){
                        echo "<div class='table-responsive'>";
                        echo "<table class='tab table table-hover'>
                                <thead>
                                    <tr class='back'>
                                        <th>Setor</th>
                                        <th>Quem solicitou</th>
                                        <th>Problema</th>
                                        <th>Descrição do Problema</th>
                                        <th>Data da solicitação</th>
                                        <th>Status</th>
                                        <th>Prioridade</th>
                                        <th>Tempo</th>
                                        <th>Visualizar solicitacao:</th>
                                        <th>Atualizar situação</th>
                                </tr>
                                </thead>";
                ?>        
                <?php  
                    while($quero = mysqli_fetch_array($cons)){
                        $idchamado = $quero['idchamado'];
                        echo "<tbody>   
                                <tr>
                                <td>" .$quero['setorcall']. "</td>
                                <td>".$quero['solicitacao']."</td>
                                <td>".$quero['desc_problema']."</td>
                                <td>".$quero['descricao']."</td>
                                <td>" .$quero['data']. "</td>
                                <td>" .$quero['status']. "</td>
                                <td>" .$quero['prioridade_desc']. "</td>
                                <td>" .$quero['sla']. "Hrs</td>
                                <td>" ?>
                                        <?php if($quero['status'] == 'Pendente'){
                                            echo "<span style='color:red;'>Pendente</span>";
                                        ?>
                                        <?php
                                            $query3 = "select * from confirma where idchamado2 = ('$idchamado')";
                                            $consulta3 = mysqli_query($con,$query3);
                                            $row3 = mysqli_num_rows($consulta3);
                                        
                                            if ($row3 > 0 ) { 
                                        ?>
                                                <span style="display: inline-block;">
                                                <a title="Nova Solicitação: ALTERAR STATUS" style="cursor: pointer;" data-toggle="modal"  data-target="#janela<?php echo "$idchamado"; ?>"><img style="display: inline; height: 50px; width: 50px;" src="img/novanotificacao2.jpg"></a>
                                        <?php 
                                                include 'include/modalconfirma.php'; 
                                            } 
                                        } else {
                                            echo "<span style='color:blue;'>Resolvido</span>"; 
                                        }
                                        ?>
                    <?php
                        echo "</td>
                                <td>"; 
                    ?>
                        <a title="Visualizar detalhes" style="cursor: pointer;" data-toggle="modal"  data-target="#janela<?php echo "$idchamado"; ?>"><img width="50px" height="50px" src="img/descricao.jpg"/></a>
                    
                    <?php  
                        include 'include/modaldescricao.php';
                        echo "</td> 
                            </tr> 
                        </tbody>"; 
                    }       
                    ?> 
                    <?php  
                        echo "</table>";
                        echo "</div>";
                    }  ?>
                    
                    <hr>  
                      
                <form action="chamado.php" method="post" name="chamado" id="chamado" oninput="ajustes(this)" >
                <br>
                <h3 class="ajust">Abrir chamado</h3>
                <br>
                    <div class="form-group text-center">
                        <label for="numaquina">Título do chamado:</label>
                        <input class="form-control" type="text" id="numaquina" name="numaquina" placeholder="Digite um título do seu problema" onkeyup="salto(this.name,this.value)" onkeypress="masc_phone(this)" required>
                    </div>
                    
                	<div class="form-group text-center">
                        <label for="motivo" >Problema:</label>
                            <select name="motivo" id="motivo" class="form-control" required>
                                <option value="">Selecione: </option>
                                <option value="1" >Internet lenta/Sem conexão</option>
                                <option value="2" >Não consigo abrir um site específico</option>
                                <option value="3" >Não consigo navegar em nenhum site</option>
                                <option value="4">Mudança de endereço</option>
                                <option value="5" >Troca do roteador </option>
                                <option value="6">Outros</option>
                            </select>
                    </div>
                    
                    <div class="form-group text-center">
                        <label for="classificacao">Prioridade</label>
                        <select name="prioridade" id="prioridade" class="form-control" required>
                            <option value="">Selecione</option>
                            <option value="1">Critica</option>
                            <option value="2">Alta</option>
                            <option value="3">Média</option>
                            <option value="4">Baixa</option>
                        </select>
                    </div>
                
                    <div  class="form-group text-center">
                    	<label for="descricao">Descrição</label>
                    	<textarea class="form-control" id="descricao" maxlength="300" name="descricao" placeholder="Descreva o problema aqui..." rows="5" id="comment"></textarea>
                    </div>
                   
                    <input type="submit" style="border: 1px solid black; margin-top: 10px;" class=" btn btn-default" name="">
                    <input type='hidden' name="idusuario" value="<?php echo $id; ?>" ></input>
                    <input style="border: 1px solid black; margin-top: 10px;" class="btn btn-danger" type="reset">
                </form>
            </div>
            
        </div>
    </section>
<div class="clear4"></div>
<?php 
    
	include "include/footer.php";
			
    if($vez == 1){
        include "include/modalsenha.php";
?>
        <script>
            $(document).ready(function(){
            $('#modalSenha').modal('show');
            });
        </script>
<?php } ?>