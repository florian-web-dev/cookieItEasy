<?php $title = 'Clients';
ob_start();

$header = '';

?>

<div class="container-fluid bg-commande">

    <?php if (isset($_SESSION['role'])) : ?>
        <?php if ($_SESSION['role'] = 'client') : ?>

            <div class="space">
                <h3 class="text-center m-4 p-3">Mes commandes</h3>
            </div>

            
            <hr>    
            <div class="m-2 d-flex justify-content-around align-items-center w-50">
                <div class="cart-box">
                    <img src="public\img\logo\card-list.svg" class="cart-info" alt="">
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
        <?php endif; ?>
    <?php endif; ?>
    

    
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Date de commande</th>
                <th scope="col">Quantité</th>
                <th scope="col">Article</th>
                <th scope="col">Date de livraison</th>
                <th scope="col">Prix total</th>
                <th scope="col">Etat</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lesCommmandes as $commmande) : ?>

                <tr>
                    <td><?= $commmande->getDateCommande() ?></td>

                    <td>
                        <?php
                        $lesCommmandesById = $objCommandeMan->fetchAllCommandebyId($commmande->getIdCommande());

                        foreach ($lesCommmandesById as $leCommmandeById) {
                            echo $leCommmandeById->getQuantiteArticle() . "<br>";
                        }
                        ?>
                    </td>

                    <td>
                        <?php foreach ($lesCommmandesById as $leCommmandeById) : ?>

                            <?php $lesArticleById = $objArticleMana->fetchByIdArticle($leCommmandeById->getIdArticle()) ?>
                            <?= $lesArticleById->getNom() . '<br>' ?>
                        <?php endforeach ?>
                    </td>


                    <td><?= $commmande->getDateLivraison() ?></td>
                    <td><?= $commmande->getTotalPanier() ?></td>
                    <td><?= $commmande->getEtat() ?></td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>
    <div class="space"></div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>