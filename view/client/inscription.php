<?php
$title = "Connexion";
ob_start(); ?>
<?php $header = 'header-' . $title; ?>

<div class="space"></div>
<div class="row align-items-start m-auto">
    <div class="container-fluid">
        <h1 class="text-center mb-5">Formulaire d'inscription</h1>
        <form novalidate action="./?path=main&action=traitementInscription" method="post" class="d-flex justify-content-center form-box">
            <section class="my-2">

                <?php
                if (isset($_SESSION["erreur"])) {
                    echo "<div class='alert-danger p-3 rounded'>";
                    foreach ($_SESSION["erreur"] as $valeur) {

                        echo $valeur . "<br>";
                        unset($_SESSION["erreur"]);
                    }
                    echo "</div>";
                }
                if (isset($_SESSION['post']['inscritpion'])) {
                    echo  $_SESSION['post']['inscritpion'];
                    unset($_SESSION['post']['inscritpion']);
                }

                ?>
                <p class="redstar">Champ obligatoire</p>
                <div class="my-2 col-lg-12 col-md-8">
                    <label for="inputPrenom" class="redstar">Prénom </label>
                    <input minlength="2" required name="prenom" id="inputPrenom" type="text" class="form-control">
                </div>

                <div class="my-2 col-lg-12 col-md-8">
                    <label for="inputNom" class="redstar">Nom </label>
                    <input minlength="2" required name="nom" id="inputNom" type="text" class="form-control">
                </div>
                <hr>
                <div class="my-2 col-lg-12 col-md-8">
                    <label for="inputNom" class="redstar">Adresse </label>
                    <input minlength="8" required name="adresse" id="inputAdresse" type="text" class="form-control">
                </div>

                <div class="my-2 col-lg-12 col-md-8">
                    <label for="inputNom" class="redstar">Ville </label>
                    <input minlength="2" required name="ville" id="inputVille" type="text" class="form-control">
                </div>

                <div class="my-2 col-lg-12 col-md-8">
                    <label for="inputNom" class="redstar">Code Postal </label>
                    <input minlength="4" required name="codepostal" id="inputCP" type="text" class="form-control">
                </div>

                <hr>

                <div class="my-2 col-lg-12 col-md-8">
                    <label for="inputEmail" class="redstar">Email </label>
                    <input required name="email" id="inputEmail" type="email" class="form-control">
                </div>
                <div class="my-2 col-lg-12 col-md-8">
                    <label for="inputMDP1" class="redstar">Mot de passe </label>
                    <span class="text-secondary fst-italic">Le mot de passe doit faire au moins 8 caractères et comporter un de ces caractères spéciaux @ ! # &, une lettre et un nombre.</span>
                    <input minlength="8" required name="mdp" id="inputMDP1" type="password" class="form-control" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@!#&])[A-Za-z\d@!#&]{8,}">
                </div>
                <div class="my-2 col-lg-12 col-md-8">
                    <label for="inputMDP2" class="redstar">Confirmation Mot de passe </label>
                    <input minlength="8" required name="mdp_confirm" id="inputMDP2" type="password" class="form-control" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@!#&])[A-Za-z\d@!#&]{8,}">
                    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>" />
                </div>

                <div class="d-flex justify-content-center my-5">
                    <button class="btn btn-info">Envoyer</button>
                </div>
            </section>
        </form>
    </div>
</div>



<!-- pattern="^(? = .*[A-Z])(? = .*[a-z])(? = .*\d)(? = .*[-+!*$@%_])([-+!*$@%_\w]{8,15})$" -->
<?php $content = ob_get_clean();
require("view/template.php"); ?>