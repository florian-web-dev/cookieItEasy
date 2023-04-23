<?php
$title = "Connexion";
ob_start(); ?>

<?php $header = 'header-' . $title; ?>

<?php if (isset($_SESSION['erreur'])) {
    //if(($_SESSION['erreur'])){foreach($_SESSION['erreur'] as $msgErreur){ }}

    echo ("<div class='text-danger text-center list-unstyled my-3'>");
    echo "<li>" . $_SESSION['erreur'] . "</li>";
    echo ("</div>");

    unset($_SESSION['erreur']);
    
}

//unset($_SESSION['erreur']);
// echo "charliechaplin@gmail.com1 sha256 = <br>";
// echo (hash("sha256", "charliechaplin@gmail.com1"));

// echo "<br> louisdefunes@gmail.com1 sha256 = <br>";
// echo (hash("sha256", "louisdefunes@gmail.com1"));

// echo "<br> bob@mail.com sha256 = <br>";
// echo (hash("sha256", "bob@mail.com1"));

// echo "<br> email@gmail.com sha256 = <br>";
// echo (hash("sha256", "email@gmail.com1"));

// echo "<br> ada@lovelace.int sha256 = <br>";
// echo (hash("sha256", "ada@lovelace.int1"));

?>

<div class="row align-items-start m-auto">
    <div class="container-fluid">

        <form method="post" action="?path=main&action=traitementLogin" class="d-flex justify-content-center">
            <section class="my-2 ">
                <h1 class="text-center mb-5"> Connexion </h1>

                <div class="my-2 col-lg-12 col-md-8">
                    <label for="inputMail">E-mail d'utilisateur</label>
                    <input required minlenght="6" id="imputMail" type="email" name="email" placeholder="example@email.com" class="form-control">
                </div>
                <div class="my-2 col-lg-12 col-md-8">

                    <label for="inputMdp">Mot de passe</label>
                    <input required minlenght="6" id="inputMdp" name="mdp" placeholder="Mot de passe" type="password" class="form-control">
                    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>" />
                </div>
                <div class="d-flex justify-content-center my-5">
                    <button class="btn btn-info">Envoyer</button>
                </div>

            </section>
        </form>

    </div>
</div>
<?php $content = ob_get_clean();
require("view/template.php"); ?>


<!-- 
<form action="./?path=main&action=traitementInscription" method="post" class="d-flex justify-content-center">
    <section class="my-2">
        <h1 class="text-center mb-5">Formulaire d'inscription</h1>
        <select class="my-2 text-center form-select  bg-info selectpicker-success text-dark"
            required name="utilisateur" id="typeUtilisateur">
            <option value="">--Choisir une option--</option>
            <option value="">Particuler</option>
            <option value="collectivité">Une collectivité</option>
            <option value="etablissement">Un établissement privé ou associatif</option>
            <option value="autre">Autre</option>
        </select>

        <div class="my-2 col-lg-12 col-md-8"><label pattern="[a-z][A-Z]{2-50}" for="inputPrenom">Prénom :</label><input
                minlength="2" required name="prenom" id="inputPrenom" type="text" class="form-control"></div>
        <div class="my-2 col-lg-12 col-md-8"><label for="inputNom">Nom :</label><input minlength="2" required name="nom"
                id="inputNom" type="text" class="form-control"></div>

        <div class="my-2 col-lg-12 col-md-8"><label for="inputEmail"></label>Email :<input required name="email"
                id="inputEmail" type="email" class="form-control"></div>
        <div class="my-2 col-lg-12 col-md-8"><label
                pattern="^(? = .*[A-Z])(? = .*[a-z])(? = .*\d)(? = .*[-+!*$@%_])([-+!*$@%_\w]{8,15})$"
                for="inputMDP1"></label>Mot de passe :<input minlength="8" required name="mdp1" id="inputMDP1"
                type="text" class="form-control"></div>
        <div class="my-2 col-lg-12 col-md-8"><label
                pattern="^(? = .*[A-Z])(? = .*[a-z])(? = .*\d)(? = .*[-+!*$@%_])([-+!*$@%_\w]{8,15})$"
                for="inputMDP2"></label>Confirmation Mot de passe :<input minlength="8" required name="mdp2"
                id="inputMDP2" type="text" class="form-control"></div>
        <div class="d-flex justify-content-center my-5"><button class="btn btn-info">Envoyer</button>
        </div>
    </section>
</form> -->