<?php $title = 'Contact';
ob_start();
?>
<?php $header = 'header-' . $title; ?>
<div class="container">
<div class="space"></div>
    <h1 class="text-center">Contact</h1>


    <div class="form-box">
        
            <?php
                if (isset($_SESSION["erreur"])) {
                    echo "<div class='alert-danger p-3 rounded'>";
                    foreach ($_SESSION["erreur"] as $valeur) {
                        
                        echo $valeur . "<br>";
                        unset($_SESSION["erreur"]);
                    }
                    echo "</div>";
                }
                if (isset($_SESSION['post']['valide'])) :?>
                    <div class="alert alert-success" role="alert">

                        <?= $_SESSION ['post']['valide'];?>

                    </div>
                    <?php
                    unset($_SESSION['post']['valide']);
                endif;
               
            ?>
        

        <form method="POST" action="?path=main&action=traitementContact" id="">
            <p class="text-muted">Fonctionne mais desactivé pour des raison de securité</p>
            <p class="redstar">Champ obligatoire</p>

            <label>Prénom </label>
            <input type="text" name="prenom" >

            <label class="redstar">Nom </label>
            <input type="text" name="nom"   required>
            <!--pattern="[a-zA-Z]{1,}"  pattern="[a-zA-Z]{1,}"-->


            <label class="redstar">Email </label>
            <input type="email" name="email" placeholder="Votre email" pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})" required><!-- pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})" required-->

            <label>Téléphone <small>(au format 01 XX XX XX XX ou 01.XX.XX.XX.XX)</small></label>
            <input type="tel" name="tel" pattern="(01|02|03|04|05|06|07|08|09)[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}[ \.\-]?[0-9]{2}" > <!-- -->


            <label>Votre message</label>
            <textarea rows="4" cols="33" name="message" pattern="[a-zA-Z]{1,}" ></textarea>
            <input type="hidden" name="token" value="<?=$_SESSION["token"]?>"/>

            <p>
                <input type="submit" value="Valider"> 
            </p>


        </form>
    </div>
</div>

<?php $content = ob_get_clean();

require('template.php');
?>
<?php
// $adresseTo = 'floriangtme@gmail.com';
// $subject= 'le sujet du mail';
// $message = 'le message du mail';

// mail($adresseTo,$subject,$message)
?>