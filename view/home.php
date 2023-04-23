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

    <article class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center margin-six-bottom">
                <p class="pCCM">Comment ça marche ?</p>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-3 row-cols-sm-2 justify-content-center box-shadow">
            <!-- start info banner  -->
            <div class="col text-center ">
                <div class="">
                    <div class="feature-box-icon">
                        <img src="public\img\logo\etape1.PNG" alt="" />
                    </div>
                    <div class="box-content">
                        <h3 class="">Adresse</h3>
                        <p class="w-75 lg-w-85 mx-auto">Entrez le nom de votre rue ou laissez-nous déterminer votre position.</p>
                    </div>
                    <div class="feature-box-overlay bg-white border-radius-8px"></div>
                </div>
            </div>
            <!-- end info banner  -->
            <!-- start info banner  -->
            <div class="col text-center ">
                <div class="">
                    <div class="feature-box-icon">
                        <img src="public\img\logo\etape2.PNG" alt="" />
                    </div>
                    <div class="">
                        <h3 class="">Sélection</h3>
                        <p class="w-75 lg-w-85 mx-auto">Quelles sont vos envies du moment ? Parcourez les menus et les avis clients pour faire votre choix.</p>

                    </div>
                    <div class="feature-box-overlay bg-white border-radius-8px"></div>
                </div>
            </div>
            <!-- end info banner  -->
            <!-- start info banner  -->
            <div class="col text-center">
                <div class="">
                    <div class="feature-box-icon">
                        <img src="public\img\logo\etape3.PNG" alt="" />
                    </div>
                    <div class="">
                        <h3 class="">Paiement et livraison</h3>
                        <p class="w-75 lg-w-85 mx-auto">Réglez en espèces ou en ligne avec votre Carte de crédit, PayPal, Bitcoin. Bon appétit !</p>

                    </div>
                    <div class="feature-box-overlay bg-white border-radius-8px"></div>
                </div>
            </div>
            <!-- end info banner  -->
        </div>
    </article>


    <div class="space"></div>


    <article class="bg-light-gray p-1">
        <div class="space"></div>
        <div class="reveal">
            <h2 class="text-center reveal-1"><?= $laCategorieBurger->getNom() ?></h2>
        </div>

        <div class="field-flex reveal card-deck">


            <?php foreach ($lesArticlesCatBurger as $article) : ?>

                <article class="item container-fluid reveal-1">
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
                                    <a href="./?path=main&action=article&id=<?= $article->getIdArticle() ?>" class="btn btn-primary">Consulter</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </article>

            <?php endforeach ?>

        </div>

        <div class="space"></div>


        <div class="reveal">
            <h2 class="text-center reveal-1"><?= $laCategorieSalade->getNom() ?></h2>
        </div>
        <div class="field-flex reveal card-deck">

            <?php foreach ($lesArticlesCatSalade as $article2) : ?>

                <article class="item container-fluid reveal-1">

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
                                    <a href="./?path=main&action=article&id=<?= $article2->getIdArticle() ?>" class="btn btn-primary">Consulter</a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                </article>

            <?php endforeach ?>


        </div>
        <div class="space"></div>
    </article>

</section>

<div class="space"></div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>