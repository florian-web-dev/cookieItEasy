<?php

$title="Modifier un Produit";

ob_start();?>
<div class="container">
    <?php 
    if(isset($_SESSION['error']))
    {
        var_dump($_SESSION['error']);
        foreach($_SESSION['error'] as $msg)
        {
            echo ("<div class='text-danger'>$msg</div> <br>");
        }

            //echo $_SESSION['error'][$key];// ici
        unset( $_SESSION['error']);
    }
    ?>
    <h2 class="d-flex justify-content-center">Formulaire d'ajout d'un Article</h2>
    
    <!-- enctype si un fichier est envoyer avec le formulaire -->
    <form novalidate action="./?path=admin&action=traitementAjoutArticle" class="col-lg-6  col-md-8 mx-auto " enctype="multipart/form-data" method="post">
        <div>
            <label for="inputNom">Nom Produit * :</label>
            <input required type="text" name="nom" id="inputNom" class="form-control" minlength="2" maxlength="100">
        </div>
        <div>
            <label for="inputPrix">Prix du Produit * :</label>
            <input required type="number" name="prix" id="inputPrix" class="form-control" min="0">
        </div>
        <div>
            <label for="inputDescription">Description :</label>
            <input type="text" name="description" id="inputDescription" class="form-control" minlength="10" maxlength="100">
        </div>

        <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="inputEstDispo" name="estDispo" value="1">
        <label class="form-check-label" for="flexSwitchCheckDefault">Article Disponible</label>
        </div>


        <div><label for="selectCategorie">Categorie * :</label>
            <select required name="idCategorie" id="selectCategorie" class="form-control">
                <option selected>choix par default </option>
            <?php 
            foreach($lesCategories as $uneCategorie)
            {
            echo ("<option value='".$uneCategorie->getIdCategorie()."'>".$uneCategorie->getNom()."</option>");
            }
            ?>
                
            </select>
            <input type="hidden" name="token" value="<?=$_SESSION["token"]?>"/>
        </div>
        <button class="btn btn-info my-2">Envoyer</button>
    </form>
</div>
<?php $content=ob_get_clean();
require('view/admin/admin-template.php');?>