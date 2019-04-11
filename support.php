<?php 
    if(empty($_COOKIE['admin'])){
        header("Location:index.php");
    }

    include "include/banco.php";

    $login = $_COOKIE['admin'];
    $query = "select idusuario from usuario where login = '$login' limit 1";
    $consulta = mysqli_query($con, $query);

    if($usuario = mysqli_fetch_array($consulta)){
        $id = $usuario['idusuario'];
    }


    $query2 = "select A.idchamado, A.data, A.setorcall, A.solicitacao, A.descricao, B.desc_problema, A.status,C.prioridade_desc,C.sla from chamados as A  LEFT JOIN tbl_problema as B ON A.id_problema = B.id_problema LEFT JOIN prioridade as C ON A.id_prioridade =C.id  where idusuario = '$id'";
    $cons = mysqli_query($con, $query2);
    $total = mysqli_num_rows($cons);

    include "include/header.php";

//Mensagens de Sucesso 
    if(isset($_GET['msagen'])){
        $msagen = $_GET['msagen'];
        $down = "down2";
        if($msagen == "right"){
            echo "<script>alert('Problema relatado com Sucesso!');</script>";  
        }else if($msagen == "up"){
            echo "<script>alert('Obrigado pela confirmação!');</script>";   
        }
    } 
    
 ?>
<div class="clearbit2"></div>
	<section >
        <div class="container">
            <div class="col-xs-12 col-md-12">
                
                <div class="clearbit0"></div>
        
            
                <h3 >Abrir Chamado</h3>
                <form action="chamado.php" method="post" name="chamado" id="chamado" oninput="ajustes(this)" >
            
                    <div class="form-group col-md-4">
                        <label for="classificacao">Prioridade</label>
                        <select name="prioridade" id="prioridade" class="form-control" required>
                            <option value="">Selecione</option>
                            <option value="1">Critica</option>
                            <option value="2">Alta</option>
                            <option value="3">Média</option>
                            <option value="4">Baixa</option>
                        </select>
                    </div>
            
            
                    <div class="form-group col-md-4">
                        <label for="motivo" >Problema:</label>
                            <select name="motivo" id="motivo" class="form-control" required>
                                <option value="">Selecione: </option>
                                <option value="1" >Internet está muito lenta</option>
                                <option value="2" >Não consigo abrir um site especifico</option>
                                <option value="3" >Não abre nenhum site</option>
                                <option value="4">Mudança de endereço</option>
                                <option value="5" >Mudança do local da instalação </option>
                                <option value="6">Outros</option>
                            </select>
                    </div>

            
            
            
                    <div  class="form-group col-md-12 ">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" maxlength="300" name="descricao"style="resize:none;" placeholder="Descreva o problema aqui..." rows="5" id="comment"></textarea>
    
                   
                    <input type="submit" style="border: 1px solid black; margin-top: 10px;" class="btn btn-primary" name="">
                    <input type='hidden' name="idusuario" value="<?php echo $id; ?>" >
                   <input style="border: 1px solid black; margin-top: 10px;" class="btn btn-danger" type="reset">
                </form>
            </div>
            </div>
            </div>
    
            
    </section>
<div class="clear4"></div>

 <?php 
    include "include/footer.php";
 ?>