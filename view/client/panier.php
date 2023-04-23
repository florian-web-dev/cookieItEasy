<?php

$title = "Mon panier";
$header = 'header-' . $title;
ob_start(); ?>
<div class="container">

    <div class="space">
        <h3 class="text-center m-4 p-3">Panier</h3>
    </div>

    <hr>
    <div class="m-2 d-flex justify-content-around align-items-center w-50">
        <div class="cart-box">
            <img src="public\img\logo\cart-fill.svg" class="cart-info" alt="">

        </div>
        <div>
            <p>Bonjours, <?= $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?> </p>
            <p>Email : <?= $_SESSION['email'] ?> </p>
        </div>
        <div>
            <p>Adresse : <?= $_SESSION['adresse'] ?> </p>
            <p>CodePostal : <?= $_SESSION['codePostal'] ?> </p>
        </div>

    </div>
    <hr>

    <table class="table table-striped table-info">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Quantite</th>
                <th scope="col">Prix unitaire</th>
                <th scope="col">Prix total</th>
            </tr>
        </thead>
        <tbody>


            <?php if (isset($_SESSION['panier'])) : ?>

                <?php //$countSession = count($_SESSION['panier']); 
                ?>


                <a href="?path=client&action=panierReste" class="btn btn-primary btn-sm float-end">Réinitialiser</a>

                <?php $totalPanier = 0 ?>
                <?php for ($i = 0; $i < count($_SESSION['panier']); $i++) : ?>

                    <?php $donneArticle = $objArticle->fetchByIdArticle($_SESSION['panier'][$i][0]); ?>

                    <tr>
                        <td> <?= $donneArticle->getNom() ?></td>
                        <td> <?= $_SESSION['panier'][$i][1] ?> </td>
                        <td> <?= $donneArticle->getPrixUnitaire() ?> € </td>
                        <td>
                            <?php $total = $donneArticle->getPrixUnitaire() * $_SESSION['panier'][$i][1] ?>
                            <?= $total ?> €
                        </td>
                    </tr>
                    <?php $totalPanier += $total;
                    $_SESSION['totalPanier'] = $totalPanier;
                    ?>

                <?php endfor ?>
                <tr>
                    <td class="bg-secondary"></td>
                    <td class="bg-secondary" colspan="2">Total Panier</td>
                    <td class="bg-secondary" colspan="1">
                        <?= $totalPanier . ' €' ?>
                    </td>
                </tr>

            <?php endif; ?>

</div>


</tbody>
</table>
<?php if (isset($_SESSION['panier'])) : ?>
    <form action="?path=client&action=paniertraitemenTable" method="POST" class="d-flex justify-content-center">
        <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>" />
        <input type="submit" value="Valider" class="btn btn-primary btn-lg">
    </form>

<?php else : ?>
    <div class="alert alert-info" role="alert">
        <p class="text-center">Votre panier est vide</p>
    </div>
<?php endif; ?>
</div>
<?php

$content = ob_get_clean();

require("view/template.php");
?>