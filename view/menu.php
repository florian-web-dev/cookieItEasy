<?php
//  require './model/manager/articleManager.php';
// $objetCatManager=new CategorieManager($lePDO);
// $uneCategorie=$objetCatManager ->fetchCategorieById($id);
//$nomCatManage = new Article($lePDO);//fetchAllCategorie()
// navbar-light bg-light menu-nav
//

?>
<header class="<?= $header ?>">
  <nav class="navbar navbar-expand-lg menu-nav">
    <div class="container-fluid ">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">

        <svg xmlns="http://www.w3.org/2000/svg" class="hsvg" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg>
      </button>
      <a class="navbar-brand" href="./">
        <img class="logo" src="./public/img/logo/logo.png" alt="">
      </a>

      <div class="collapse navbar-collapse bg-navItem" id="navbarToggler">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-around">

          <div class="d-flex me-5">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="./?path=main&action=home">Accueil</a>
            </li>
            <?php if (isset($lesCategories)) : ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Nos plats
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="">
                  <?php foreach ($lesCategories as $uneCategorie) : ?>
                    <li class="nav-item">
                      <a class='nav-link dropdown-item' href='?path=main&action=categorie&id=<?= $uneCategorie->getIdCategorie() ?>'><?= ucfirst($uneCategorie->getNom()) ?></a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php endif; ?>

            <li class="nav-item">
              <a class="nav-link " href="./?path=main&action=contact">Contact</a>
            </li>
          </div>


        </ul>

        <div class="d-flex align-items-center">

          <?php if (isset($_SESSION['role'])) : ?>
            <?php if ($_SESSION[('role')] == 'admin') : ?>
              <div class="nav-item">
                <a class="nav-link " href="./?path=main&action=formInscription">Inscription</a>
              </div>

          <?php endif;
          endif; ?>

          <?php if (!isset($_SESSION['email'])) : ?>
            <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSignIn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                S'identifier
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownSignIn">

                <li class="dropdown-item">
                  <a class="nav-link " href="./?path=main&action=formInscription">Inscription</a>
                </li>
                <li class="dropdown-item">
                  <a class="nav-link " href="./?path=main&action=formLogin">Se connecter</a>
                </li>

              <?php else : ?>
                <li class="dropdown-item">
                  <a class="nav-link " href="./?path=main&action=logout">Se deconnecter</a>
                </li>


              </ul>
            </div>
          <?php endif; ?>


          <?php if (isset($_SESSION['role'])) : ?>

            <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownRole" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Mon espace
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownRole">
                <?php if ($_SESSION[('role')] == 'client') : ?>

                  <li class="dropdown-item">
                    <?= "Bonjour, " . $_SESSION['nom'] . " " . $_SESSION['prenom'] ?>
                  </li>

                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li class="dropdown-item">

                    <a class="nav-link" href="./?path=client&action=panier">Panier
                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                      </svg>

                    </a>
                  </li>

                  <li class="dropdown-item">
                    <a class="nav-link" href="./?path=client&action=clientCommandes">Mes commandes</a>
                  </li>
              <?php endif;
              endif; ?>
              <?php if (isset($_SESSION['role'])) : ?>
                <?php if ($_SESSION[('role')] == 'admin') : ?>
                  <li class="dropdown-item">
                    <?= "Bonjour, " . $_SESSION['nom'] . " " . $_SESSION['prenom'] ?>
                  </li>
                  <li class="dropdown-item">
                    <a class="nav-link" href="./?path=admin&action=admin">Back office</a>
                  </li>
              <?php endif;
              endif; ?>
              </ul>
            </div>





        </div>

      </div>




    </div>

  </nav>


</header>