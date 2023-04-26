<?php $title = 'Home'; ?>

<?php ob_start(); ?>

<?php $header = 'header-' . $title; ?>

<div class="container">

    <h1 class="text-center my-4">Food Easy Home</h1>

    <?php if (isset($_SESSION['succes'])) {
        echo $_SESSION['succes'];
        unset($_SESSION['succes']);
    } ?>

</div>
<section class="big-section">
    <!------------------------------------------------------------------------------->
    <!------------------------- banner "Comment ça marche" -------------------------->
    <!------------------------------------------------------------------------------->
    <?php
    include_once "view/fragments/bannerHome.php";
    ?>
    <!------------------------------------------------------------------------------->
    <!------------------------- banner "Comment ça marche" -------------------------->
    <!------------------------------------------------------------------------------->

    <div class="space"></div>


    <article class="bg-light-gray p-1">
        <div class="space"></div>

        <div class="reveal">
            <h2 class="text-center reveal-1"><?= $laCategorieBurger->getNom() ?></h2>
        </div>

        <div class="field-flex reveal card-deck ">


            <?php foreach ($lesArticlesCatBurger as $article) : ?>

                <div class="item container-fluid reveal-1 box-shadow">
                    <div>
                        <div class="item-image reveal-2">
                            <img src="./public/img/articles/<?= $laCategorieBurger->getNom() ?>/<?= $article->getNom() ?>.png" alt="image 1">
                        </div>
                        <div class="item-body reveal-3">
                            <div class="item-title ">
                                <?= $article->getNom() ?>
                                <p class="prix text-center"><?= $article->getPrixUnitaire() ?>€</p>
                            </div>
                            <div class="item-description ">
                                <p><?= $article->getDescription() ?></p>
                            </div>

                            <div class="field-flex">
                                <?php if (empty($_SESSION['role']) || $_SESSION['role'] != 'client') : ?>

                                    <a href="./?path=main&action=formLogin" class="btn btn-info">Se connecter</a>
                                    <a href="./?path=main&action=formInscription" class="btn btn-info">S'inscrire</a>
                                <?php else : ?>
                                    <a href="./?path=main&action=article&id=<?= $article->getIdArticle() ?>" class="btn btn-info">Consulter</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>

            <?php endforeach ?>

        </div>

        <div class="space"></div>


        <div class="reveal">
            <h2 class="text-center reveal-1"><?= $laCategorieSalade->getNom() ?></h2>
        </div>
        <div class="field-flex reveal card-deck">

            <?php foreach ($lesArticlesCatSalade as $article2) : ?>

                <div class="item container-fluid reveal-1 box-shadow">

                    <div>
                        <div class="item-image reveal-2">
                            <img src="./public/img/articles/<?= $laCategorieSalade->getNom() ?>/<?= $article2->getNom() ?>.png" alt="image 1">
                        </div>
                        <div class="item-body reveal-3">
                            <div class="item-title ">
                                <?= $article2->getNom() ?>
                                <p class="prix text-center"><?= $article2->getPrixUnitaire() ?>€</p>
                            </div>
                            <div class="item-description">
                                <p><?= $article2->getDescription() ?></p>
                            </div>

                            <div class="field-flex">

                                <?php if (empty($_SESSION['role']) || $_SESSION['role'] != 'client') : ?>

                                    <a href="./?path=main&action=formLogin" class="btn btn-info">Se connecter</a>
                                    <a href="./?path=main&action=formInscription" class="btn btn-info">S'inscrire</a>
                                <?php else : ?>
                                    <a href="./?path=main&action=article&id=<?= $article2->getIdArticle() ?>" class="btn btn-info">Consulter</a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                </div>

            <?php endforeach ?>


        </div>
        <div class="space"></div>
    </article>

</section>

<div class="space"></div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>