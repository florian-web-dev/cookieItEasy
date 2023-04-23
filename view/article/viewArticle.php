<?php
$title = 'Article';
ob_start();
$nomCategorie = $IdCategorie->getNom();
$header = 'header-' . $nomCategorie;

?>
<div class="container reveal">
  <!-- <div class="space"></div> -->
  <h3 class="reveal-1 text-center m-2 p-2"><?= ucfirst($donneArticle->getNom()) ?></h3>
  
  <div class="row align-items-center">
    <div class=" col-lg-6 text-center reveal-2">
      <img src="./public/img/articles/<?= $nomCategorie ?>/<?= $donneArticle->getNom() ?>.png" class="w-50 " alt="Image de l'article">
    </div>
    <div class=" col-lg-6 d-flex-column reveal-2">

      <div class="reveal-3">
        <h4>Description :</h4>
        <p class="p-1"><?= $donneArticle->getDescription() ?></p>

        <p><?php
            if ($donneArticle->getEstDisponible()) {
              echo "<p class='text-success'> Article diponible</p>";
            } else {
              echo "<p class='text-danger'> Article indiponible</p>";
            }
            ?>
        </p>

        <p class="prix my-3">Prix : <?= $donneArticle->getPrixUnitaire()  ?> €</p>
      </div>
      <?php if (empty($_SESSION['role']) || $_SESSION['role'] != 'client') : ?>

        <a href="?path=main&action=formLogin" class="btn btn-info">Se connecter</a>
        <a href="?path=main&action=formInscription" class="btn btn-info">S'inscrire</a>

      <?php else : ?>
        <hr>
        <form novalidate action="./?path=client&action=traitementAjoutPanier" method="post" class="">
          <h4>Commander l'article</h4>

          <input type="hidden" name="idArticle" value="<?= $donneArticle->getIdArticle()  ?>" required>
          <label for="inputQuantite">Nombre d'article :</label>
          <div class="col-sm-5">
            <input type="number" name="quantite" id="inputQuantite" min="0" max="20" size="2" required class="form-control">
            <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>" />
          </div>
          <button class="btn btn-danger my-2">Ajouter au panier</button>
        </form>
      <?php endif ?>
    </div>
  </div>
</div>
<div class="space"></div>

<?php
$content = ob_get_clean();
require("view/template.php"); ?>