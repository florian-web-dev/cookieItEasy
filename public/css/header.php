<?php
$objCategoriManager = new CategorieManager($lePDO);
$lesCategories = $objCategoriManager->fetchAllCategorie();

?>
<?php foreach ($lesCategories as $uneCategorie) : ?>

    <?php
    $Catname = $uneCategorie->getNom();
    $headerClassName = '.header-' .  $uneCategorie->getNom();
    $headerUrl = "url(./public/img/header/" . $uneCategorie->getNom() . ".jpg)";
    
  echo "<style type='text/css'>
    
    $headerClassName {
        background-image: linear-gradient(rgb(2 2 2 / 38%), rgba(10, 10, 10, 0.22)), $headerUrl;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 100%;
        height: 80vh;
    }
        </style>";

 endforeach; ?>


<!-- ../img/header/Desserts.jpg -->



