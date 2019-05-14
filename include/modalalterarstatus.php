<?php include 'banco.php'; ?>
<!-- MODAL ALTERAR 'STATUS' -->
    <div class="modal fade" id="janela<?php echo "$idchamado"; ?>">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ALTERAR STATUS:</h4>  
                </div>

                <div class="modal-body">
                    <p style="border: 1px solid lightgray;"><?php echo $quero['descricao']; ?></p>
                    <p><strong> DATA: </strong>
                        <?php echo $quero['data']; ?>
                        </br>
                        
                        <form action="alterarstatus.php" method="post">
                            <strong>Status:</strong>
                            <select name="status" >
                                <option readonly   disabled>Pendente</option>
                                <option value="resolvido" required>Resolvido</option>
                            </select>
                        </form> 
                        <p>
                        <?php
                            $query_respostas = "SELECT
                                                    id,
                                                    IFNULL(resposta,'') AS resposta,
                                                    IFNULL(u.nome,'') AS usuario,
                                                    IFNULL(data,'') AS data,
                                                    IFNULL(hora,'') AS hora
                                                FROM respostas r
                                                INNER JOIN usuario u ON u.idusuario = r.idusuario
                                                WHERE r.idchamado = '$idchamado'
                                                ORDER BY r.id";
                            $respostas = mysqli_query($con, $query_respostas);
                        
                        ?>
                            <strong>Respostas Anteriores</strong>
                            <?php 
                                while($resp = mysqli_fetch_array($respostas)){
                            ?>
                                <div class="form-group">
                                    <textarea class="form-control" rows="2" id="comment" readonly><?php echo $resp['resposta']; ?></textarea>
                                    <p>Postado por <?php echo $resp['usuario']; ?> as <?php echo $resp['hora']; ?> do dia <?php echo $resp['data']; ?></p>
                                </div>
                            <?php } ?>
                            <form method="post" action="comentario.php">
                                <div class="form-group">
                                    <label for="comment">Responda:</label>
                                    <textarea name="resposta" class="form-control" rows="2" id="comment" required></textarea>
                                    <input type="hidden" name="idusuario" value="<?php echo $id; ?>">
                                    <input type="hidden" name="idchamado" value="<?php echo $idchamado; ?>">
                                    <input type="hidden" name="modal" value="admin">
                                </div>
                                <button type="submit" style="border: 2px solid black;" class="btn btn-primary">Postar Resposta</button>
                            </form>
                        </p>
                            </br>
                    </p>
                </div>

                <div class="modal-footer">
                    <button style="border: 2px solid black;" class="btn btn-default" data-dismiss="modal">Cancelar</button>                            
                    <button type="submit" data-toggle="modal" title="tem certeza?" style="border: 2px solid black;" class="btn btn-primary" data-dismiss="modal" data-target="#janela3<?php echo "$idchamado"; ?>">Alterar</button>
                </div>
            </div>
        </div>
    </div>

<!-- MODAL 'TEM CERTEZA? ' -->
    <div class="modal fade" id="janela3<?php echo "$idchamado"; ?>">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-body">
                    <h3><strong>Tem certeza?</strong></h3>
                    <input type="hidden" name="idchamado" value="<?php echo $idchamado; ?>"></input>   
                    <button data-dismiss="modal" class="btn btn-default">Não</button>
                    <button href="alterarstatus.php" class="btn btn-primary">Sim</button>
                </div>
            </div>
        </div>
                        </form>
    </div>
                                </span>