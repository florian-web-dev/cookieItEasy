<?php
//@todo refactoring poo
//$title="$laCategorie[nom]";
$title = $laCategorie->getNom();


ob_start(); ?>
<div class="container reveal">

    <h3 class="reveal-1 text-center m-2 p-2"><?= ucfirst($title) ?></h3>

    <div class="d-flex justify-content-around row card-deck">
        <?php
        $header = 'header-' . $laCategorie->getNom();
        //var_dump($lesArticles);
        foreach ($lesArticles as $unArticle) { ?>
            <div class="card mx-1 my-2 reveal-2" style="width: 20rem;">
                <img class="card-img-top" src="./public/img/articles/<?= $laCategorie->getNom() ?>/<?= $unArticle->getNom() ?>.png" alt="Card image cap">
                <div class="card-body" style="display: flex; flex-direction:column; justify-content:space-between;">
                    <h5 class="card-title reveal-3"><?= $unArticle->getNom() ?></h5>
                    <p class="card-text prix reveal-3"><?= $unArticle->getPrixUnitaire() ?>€</p>


                    <?php
                    if ($unArticle->getEstDisponible()) {
                        echo "<p class='text-success'> Article diponible</p>";
                    } else {
                        echo "<p class='text-danger'> Article indiponible</p>";
                    }
                    ?>
                    <a href="./?path=main&action=article&id=<?php echo $unArticle->getIdArticle() ?>" class="btn btn-primary">Consulter</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <br>
</div>
<?php

$content = ob_get_clean();

require("view/template.php");
?>