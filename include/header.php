<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Help Desk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!--Style -->
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body >

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header text-center ">
                <a href="index.php"></a>
                <h3>System Help Desk </h3>
                    
                <!-- OCULTA O MENU NAVEGAÇÃO NA PÁGINA DE LOGIN INDEX-->    
                <!-- EXIBE O MENU NAVEGAÇÃO QUANDO ESTIVER LOGADO-->
                <?php 
                if((isset($_COOKIE['admin'])) or (isset($_COOKIE['usuario'])) or (isset($_COOKIE['tecnico']))){
                ?>
                    
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra-navegacao">
                    <span class="sr-only">Alternar Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                   
            </div>
                 
            <div class="collapse navbar-collapse" id='barra-navegacao'>  
                <!-- Lista dos links de navegação -->
                <ul class="nav navbar-nav navbar-right">

                <?php 
                if (isset($_COOKIE['tecnico'])) {          
                    $login = $_COOKIE['tecnico'];
                    $q = "select * from usuario where login = '$login'";
                    $c = mysqli_query($con,$q);
                    
                    if ($u = mysqli_fetch_assoc($c)){
                        $setor = $u['setor'];
                    }
                    
                    if ($setor == "helpdesk"){
                ?>
                        <li class="tecnico"><a  style="cursor: default;">Técnico</a></li>
                    <?php } 
                }
                    
                if (isset($_COOKIE['usuario'])) {
                ?>
                    <li class="user"><a  style="cursor: default;">User</a></li>
                <?php } ?>
                        <!-- Exibe links de Inicio, Cadastrar, Usuarios, etc.. 'Apenas para o administrador' -->
                
                <?php 
                    if((isset($_COOKIE['admin'])) or (isset($_COOKIE['tecnico']))){
                        if(isset($_COOKIE['admin'])){
                ?> 
                            <li><a class="ativo" href="home.php">Início</a></li>
                            <li><a href="support.php">Cadastrar Chamado</a></li>
                            <li><a  href="cadastro.php">Cadastrar Usúario</a></li>
                            <!--begin to dropdown!-->
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuários<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="usuarios.php">Ativos</a></li>
                                    <li><a href="desativado.php">Desativados</a></li>
                                </ul>
                            </li>
                            
                    <?php
                            }
                        if((isset($_COOKIE['admin'])) or (isset($_COOKIE['tecnico']))){  
                    ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Registros<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                               
                                    <li><a href="pdf/pendente.php">Chamados Pendentes</a></li>
                                    <li><a href="pdf/resolvido.php">Chamados Resolvidos</a></li>
                                    <li><a href="pdf/todos.php">Todos os Chamados</a></li>
                        <?php }
                        
                                if(isset($_COOKIE['admin'])){ ?>
                                    <hr>
                                    <li><a href="pdf/ativo.php">Funcionários Ativos</a></li>
                                    <li><a href="pdf/desativo.php">Funcionários Desativos</a></li>
                                    <hr>
                                    <li><a href="importar.php">Importar XML</a></li>
                                    <li><a href="exportarxml.php">Exportar XML</a></li>
                        <?php } ?>
                                </ul>
                            </li>
                        <?php } ?> <!-- Encerra código que bloqueia links -->

                        <li  class="separador" role="separator"></li>
                          
                          <!-- Exibe o link 'SAIR' para todos: Usuário ou admin.  -->
                        <?php 
                        if(isset($_COOKIE['usuario']) or (isset($_COOKIE['admin'])) or (isset($_COOKIE['tecnico']))){
                           ?>
                            <li id="sair"><a href="sair.php">Sair</a></li>
                        <?php } } ?>
                </ul>
            </div>
        </div>
    </nav>
    
   
 
