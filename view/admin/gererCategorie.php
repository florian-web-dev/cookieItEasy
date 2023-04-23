<?php $title = 'Gérer une catégorie '; ?>

<?php ob_start(); ?>
<section class="container-fluid row align-items-center text-center">
    <h2><?= $title ?></h2>


    <?php if (isset($_SESSION['msg'])) : ?>
        <div class="alert alert-info" role="alert">
            <h5><?= $_SESSION['msg']; ?></h5>

        </div>
    <?php endif; ?>

    <div class="col">
        <table class="table table-dark table-striped table-hover table-bordered border-white">
            <thead>
                <tr>
                    <th colspan="2">Catégorie </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lesCategories as $categorie) : ?>
                    <tr>
                        <td><?= $categorie->getNom() ?></td>

                        <td class="d-flex justify-content-center">

                            <form action="?path=admin&action=supprimerCategorie" class="d-flex" method="post">
                                <input type="hidden" name="idCategorie" id="" required value="<?= $categorie->getIdCategorie() ?>">
                                <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
                                <button class="btn btn-danger mx-2">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="col">
    <hr>
        <div>
            <h3>Ajouter un catégorie</h3>
            <form action="./?path=admin&action=traitementAddCategorie" method="POST">
                <input type="text" name="addCategorie">
                <button class="btn btn-info my-2">Envoyer</button>
            </form>
        </div>
        <hr>
        <div>
            <h3>Modifier une catégorie</h3>
            <form action="?path=admin&action=modifierCategorie" method="post">
                <div class="w-50 m-auto">
                    <label for="selectCategorie"></label>

                    <select required name="idCategorie" id="selectCategorie" class="form-select" aria-label="Select catégorie">
                        

                        <?php foreach ($lesCategories as $uneCategorie) : ?>

                            <option value="<?= $uneCategorie->getIdCategorie() ?>"><?= $uneCategorie->getNom() ?></option>

                        <?php endforeach ?>

                    </select>
                </div>
                <div class="m-3">
                    <input type="text" name="modifCategorie" id="" required>
                </div>

                <button class="btn btn-danger mx-2">Modifier</button>
            </form>
        </div>
        <hr>
    </div>

</section>





<?php $content = ob_get_clean(); ?>

<?php require('view/admin/admin-template.php'); ?>