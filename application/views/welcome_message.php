<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?=$base_url?>assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?=$base_url?>assets/css/style.css">
    </head>
    <body>
    <button id="btnSalvar" class="btn btn-success" name="news">Salvar newsletter</button>
    <?php
        //listar as newletters obtidas da pagina
        for($i = 0; $i < count($arrDados); $i++ ) {
    ?>
        <div class="row">

            <div class="col-md-12 col-xs-10">

                <p>
                    <input type="checkbox" value="<?=$i?>" name="news"/>
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

    <script src="<?=$base_url?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?=$base_url?>assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?=$base_url?>assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    </body>
</html>
