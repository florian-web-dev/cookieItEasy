
<?php
// if(isset($_SESSION['error']))
// {
//     var_dump($_SESSION['error']);
//     foreach($_SESSION['error'] as $msg)
//     {
//         echo ("<div class='text-danger'>$msg</div> <br>");
//     }
//     foreach($_SESSION['error'] as $key)
//     {
//         echo ("<div class='text-danger'>$key</div> <br>");
//     }
// }
// echo 'bob';
// var_dump($_POST);
// print_r($_POST);

//------------------------------------------- ici formuliare de contact -------------------------------------------
// Affichage des valeurs
// echo "Prénom :$prenom";
// echo "<br>";
// echo "Nom :$nom";
// echo "<br>";
// echo "Email :$email";
// echo "<br>";
// echo "Message :$message";
// echo "<br>";
// echo "<hr>";
// echo 'SESSION <br>';
//  var_dump($_SESSION);
// echo $v;
//  echo "<hr>";
//  echo 'va <br>';

//  echo $va;

//------------------------------------------- ici Formulaire d'inscription -------------------------------------------


// $prenom = $_POST['prenom'];
// $nom = $_POST['nom'];
// $adresse = $_POST['adresse'];
// $ville = $_POST['ville'];
// $codepostal = $_POST['codepostal'];
// $email = $_POST['email'];
// $mdp = $_POST['mdp'];
// $mdp_confirm = $_POST['mdp_confirm'];
// var_dump($_POST);

// print_r($_POST);
// echo $errors[$key];
// echo $_SESSION['error'][$key];
// echo $_SESSION['erreur'];
// echo $_SESSION['erreur']['codepostal'];

// echo "<br>";
// echo "Prénom :$prenom";
// echo "<br>";
// echo "Nom :$nom";
// echo "<br>";
// echo "Adresse :$adresse";
// echo "<br>";
// echo "Ville :$ville";
// echo "<br>";
// echo "Code Postal :$codepostal";
// echo "<br>";
// echo "Email :$email";
// echo "<br>";
// echo "Mot de passe  :$mdp";
// echo "<br>";
// echo "Confirmation Mot de passe  :$mdp_confirm";
// echo "<br>";


//-----------------------------------------------------
// $chaine = '@!#&';

// $random = rand(0, 3);
// echo $random . "<br>";

// for ($i = 0; $i < 10; $i++) {

//     $newMdp = sha1($chaine[$random] . "Portezcevieuxwhiskyaujugeblondquifume");

//     $random = rand(0, 3);
//     $newMdp = substr($newMdp, 0, 7) . $chaine[$random];
//     // echo "ORI :" . $newMdp  ."<br>";
//     explode(" ", $newMdp, 2);
//     $arry = str_split($newMdp);
//     $random1 = rand(0, count($arry) - 2);
//     $temp = $arry[$random1];
//     $arry[$random1] =  $arry[7];
//     $arry[7] =  $temp;

//     echo $newMdp = implode($arry) . "<br>";
// }

function newRandomMdp()
{
    $chaine = '@!#&';
    $random = rand(0, 3);
    for ($i = 0; $i < 1; $i++) {

        $newMdp = sha1($chaine[$random] . "Portezcevieuxwhiskyaujugeblondquifume");
        $random = rand(0, 3);
        $newMdp = substr($newMdp, 0, 7) . $chaine[$random];
        // echo "ORI :" . $newMdp  ."<br>";
        explode(" ", $newMdp, 2);
        $arry = str_split($newMdp);
        $random1 = rand(0, count($arry) - 2);
        $temp = $arry[$random1];
        $arry[$random1] =  $arry[7];
        $arry[7] =  $temp;

       echo $newMdp = implode($arry) . "<br>";
    }return $newMdp;
}
newRandomMdp();



?>