<?php
$title = '404';
ob_start();
$header = 'header-' . $title;
?>

<div class="container">
    <div class="d-flex flex-row-reverse justify-content-around m-2 align-items-center">
        <div>
            <h1 class="p-2 m-3">404 : Page introuvable</h1>
            <a class="text-decoration-none btn btn-info" href="./">Retour à l'accueil</a>
        </div>



        <div class="">
            <img src="./public/img/oops.jpg" alt="Page introuvable 404 oops">

        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
require('template.php');
?>