<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?=$base_url?>assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?=$base_url?>assets/css/style.css">
    </head>
    <body>
    <div class="col-md-12">
        <div id="noticias">
    <?php
        //Exibe as newsletters escolhidas pelo usuário
        for($i = 0; $i < count($arrDados); $i++ ) {
    ?>
        <div class="row">

            <div class="col-md-12 col-xs-10">

                <p>
                    <?php echo $arrDados[$i]['title']; ?>
                </p>
                <p>
                    <a class="btn btn-primary" href="<?php echo $arrDados[$i]['link']; ?>">Leia mais</a>
                    <br><?php echo $arrDados[$i]['date'];?>
                </p>
            </div>
        </div>
            <hr>
    <?php
        }
    ?>
        </div>
        <button id="btnEnviar" class="btn btn-success">Enviar</button>
    </div>

    <script src="<?=$base_url?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?=$base_url?>assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?=$base_url?>assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    </body>
</html>
