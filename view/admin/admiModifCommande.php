<?php
$title = "Modifier commandes";
ob_start(); ?>

<h2><?= $title ?></h2>
<table class="table table-dark table-striped table-hover table-bordered border-white">

    <thead>
        <tr class="text-center">
            <th scope="col"> n°</th>
            <th scope="col">Article</th>
            <th scope="col">Quantite</th>
            <th scope="col">Prix</th>
            <th scope="col">Client</th>
            <th scope="col">Date commande</th>
            <th scope="col">Etat</th>
            <th scope="col">Action</th>
        </tr>
    </thead>

    <tbody class="text-center">
        <?php foreach ($lesCommandes as $commande) : ?>

            <tr>

                <td class="w-auto"><?= $commande->getIdCommande(); ?></td>
                <td class="text-start ps-3">

                    <?php $lesArticleComande = $objCommandeMana->fetchAllCommandebyId($commande->getIdCommande());

                    foreach ($lesArticleComande as $unArticleCommande) {
                        //var_dump($unArticleCommande);
                        $unArticle = $articleManager->fetchByIdArticle($unArticleCommande->getIdArticle());
                        echo $unArticle->getNom() . "<br>";
                    }
                    ?>
                </td>
                <td>
                 
                    <?php foreach ($lesArticleComande as $unArticleCommande) {

                        echo $unArticleCommande->getQuantiteArticle() . "<br>";
                    }
 
                    ?>
                </td>
                <td>
                    <?= $commande->getTotalPanier() . " €"; ?>
                </td>

                <td>
                    <?php
                    $client = $objClientMana->fetchClientById($commande->getIdClient());
                    // var_dump($client);
                    echo $client->getNom();
                    ?>
                </td>

                <td><?= $commande->getDateCommande(); ?></td>
                <td><?= $commande->getEtat(); ?>
                <a class="btn btn-danger mx-2" href="?path=admin&action=modiCommandetraitement&idCommande=<?= $commande->getIdCommande() ?>">Modifier</a>
            </td>

                <td>
                    <form action="?path=admin&action=supprimerCommande" class="d-flex" method="post">
                        <input type="hidden" name="idCommande" id="" required value="<?= $commande->getIdCommande() ?>">
                        <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
                        <button class="btn btn-danger mx-2">Supprimer</button>
                    </form>
                </td>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();

require('view/admin/admin-template.php');
?>