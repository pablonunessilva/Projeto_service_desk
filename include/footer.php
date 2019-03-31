    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
               
                <?php
                    if(isset($_COOKIE['tecnico'])){
                        $namepc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        echo "<h5 class='phfooter'>Nome do dispositivo: $namepc</h5>"; 
                    }
                ?>
                    <p class="">&copy; Serviçes Desk </p>
                    <h5 class="center">Five ++</h5>
                </div>
            </div>
        </div> 
    </footer>
    <script src="js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>

 
</body>
</html>   