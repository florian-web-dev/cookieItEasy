<?php
$title = "Commandes";
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
        </tr>
    </thead>

    <tbody class="text-center">
        <?php foreach ($lesCommandes as $commande) : ?>

            <tr >

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
                    
                    <?php $totalQuantite = 0 ?>
                    <?php foreach ($lesArticleComande as $unArticleCommande) {
                        
                        echo $unArticleCommande->getQuantiteArticle() . "<br>";

                        
                    }
                   
                    ?>
                </td>
                <td>
                    <?= $commande->getTotalPanier() . " €";?>
                </td>

                <td>
                    <?php
                    $client = $objClientMana->fetchClientById($commande->getIdClient());
                    // var_dump($client);
                    echo $client->getNom();
                    ?>
                </td>

                <td><?= $commande->getDateCommande(); ?></td>
                <td><?= $commande->getEtat(); ?></td>

            </tr>

        <?php endforeach ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();

require('view/admin/admin-template.php');
?>