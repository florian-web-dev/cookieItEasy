<?php
$title = "Les articles";
ob_start(); ?>
<div class="container">
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

  <table class="table table-dark table-hover">
    <thead>
      <tr>

        <th scope="col">Nom</th>
        <th scope="col">Descriptions</th>
        <th scope="col">Prix Unitaire</th>
        <th scope="col">Est disponible</th>
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
          <td class="w-50"><?= $article->getDescription();?></td>
          <td><?= $article->getPrixUnitaire() ?> €</td>
          <td> <?php
                if ($article->getEstDisponible()) {
                  echo "<p class='text-success'> Article diponible</p>";
                } else {
                  echo "<p class='text-danger'> Article indiponible</p>";
                }
                ?></td>



          </td>

        </tr>
      <?php endforeach ?>

    </tbody>
  </table>
  <br>
</div>
<?php

$content = ob_get_clean();

require('view/admin/admin-template.php');
?>