<?php
include "include/banco.php";
include "include/header.php";?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="clearbit0">
                    <h3>Importar XML</h3>

                    <form action="processaxml.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="xml">Selecione o arquivo</label>
                                <input type="file" name="xml" id="xml">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <input type="submit" style="border: 1px solid black; margin-top: 10px;" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "include/footer.php";