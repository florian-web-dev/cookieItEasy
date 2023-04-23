<?php
$title = "Administration des articles";
ob_start(); ?>
<div class="container ">
  <h2><?= $title ?></h2>
  <?php if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    //unset($_SESSION['msg']);
  }
  if (isset($_SESSION['error'])) {

    echo $_SESSION['error'];
    // foreach($_SESSION['error'] as $key)
    // {
    //     echo ("<div class='text-danger'>$key</div> <br>");
    // }
  }

  ?>

  <table class="table table-dark table-hover text-center">
    <thead>
      <tr>

        <th scope="col">Nom</th>
        <th scope="col">Prix Unitaire</th>
        <th scope="col">Est disponible</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //@todo afficher les lignes
      ?><?php //var_dump($lesArticles)
        ?>
      <?php foreach ($lesArticles as $article) : ?>
        <tr>

          <td><?= $article->getNom() ?></td>
          <td><?= $article->getPrixUnitaire() ?> €</td>
          <td><?php
                if ($article->getEstDisponible()) {
                  echo "<p class='text-success'> Article diponible</p>";
                } else {
                  echo "<p class='text-danger'> Article indiponible</p>";
                }
                ?></td>
          <td class="d-flex justify-content-center">

            <a class="btn btn-danger mx-2" href="?path=admin&action=formModifArticle&idArticle=<?= $article->getIdArticle() ?>">Modifier</a>
            <form action="?path=admin&action=supprimerArticle" class="d-flex" method="post">
              <input type="hidden" name="idArticle" id="" required value="<?= $article->getIdArticle() ?>">
              <input type="hidden" name="token" value="<?=$_SESSION["token"]?>"/>
              <button class="btn btn-danger mx-2">Supprimer</button>
            </form>
          </td>

        </tr>
      <?php endforeach ?>
      <?php
      // }
      ?>
    </tbody>
  </table>
  <br>
</div>
<?php

$content = ob_get_clean();

require('view/admin/admin-template.php');
?>