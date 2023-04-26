<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require_once 'model/manager/categorieManager.php';
// require_once 'model/manager/articleManager.php';
// require_once 'model/manager/clientManager.php';
// require_once 'model/manager/adminManager.php';


if (!isset($_GET['action'])) {
    $action = "home";
} else {
    $action = $_GET['action'];
}

switch ($action) {
    case "home":
        $articleManager = new ArticleManager($lePDO);
        $lesArticlesCatBurger = $articleManager->fetchArticleByCatLimite(1, 3);


        $articleManager = new ArticleManager($lePDO);
        $lesArticlesCatSalade = $articleManager->fetchArticleByCatLimite(2, 3);


        $laCategorieManager = new CategorieManager($lePDO);
        $laCategorieBurger = $laCategorieManager->fetchCategorieById(1);

        $laCategorieManager = new CategorieManager($lePDO);
        $laCategorieSalade = $laCategorieManager->fetchCategorieById(2);

        require('view/home.php');
        break;



    case "categorie":
        $idCateg = filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //j'instancie CategorieManager
        $laCategorieManager = new CategorieManager($lePDO);
        //j'utilise la methode fetchCategorieById de la Classe CategorieManager objet = $laCategorieManager
        $laCategorie = $laCategorieManager->fetchCategorieById($idCateg);

        //var_dump($laCategorie);

        $articleManager = new ArticleManager($lePDO);
        $lesArticles = $articleManager->fetchAllArticleByIdCateg($idCateg);

        // $lesArticles=fetchAllArticleByIdCateg($idCateg);
        //var_dump($lesArticles);
        require('view/categorie/categorie.php');
        break;

    case "article":
        $idArticle = filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $idCateg = filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // @todo 

        $laCategorieManager = new CategorieManager($lePDO);



        $allArticle = new ArticleManager($lePDO);
        $donneArticle = $allArticle->fetchByIdArticle($idArticle);
        // var_dump($donneArticle);
        $IdCategorie = $laCategorieManager->fetchCategorieById($donneArticle->getIdCategorie());


        require("view/article/viewArticle.php");
        break;

    case "formLogin":
        require("view/login.php");
        break;
    case "traitementLogin":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
                header("Location: view/404.php");
                exit();
            }
            if ($_POST["token"] == $_SESSION["token"]) {
                if (isset($_POST)) {
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    // $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $mdp = filter_var($_POST['mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $mdp = hash('sha256', $mdp);

                    //j'instencie le ClientManager
                    $objClienMana = new ClientManager($lePDO);
                    //je crée une variable client qui me permetra d'optenir 
                    //via la methode de la class une reponse de ma base de donné
                    $client = $objClienMana->fetchClientByEmailAndMdp($email, $mdp);

                    $objAdminMana = new AdminManager($lePDO);
                    $admin = $objAdminMana->fetchAdminByEmailAndMdp($email, $mdp);

                    // je verifie si client ne pas vide ou null si oui erreur
                    if (empty($client) && empty($admin)) {
                        $_SESSION['erreur'] = 'email et  ou mots de passe non valide';
                        header("Location: ./?path=main&action=formLogin");
                    }
                    if ($client) {
                        //Je donne les valeurs du client qui se connecte a SESSION
                        $_SESSION['prenom'] = $client->getPrenom();
                        $_SESSION['nom'] = $client->getNom();
                        $_SESSION['email'] = $client->getEmail();
                        $_SESSION['id'] = $client->getIdClient();
                        $_SESSION['adresse'] = $client->getAdresse();
                        $_SESSION['codePostal'] = $client->getCodePostal();
                        $_SESSION['role'] = "client";
                        //je redirige vers l'index
                        header("Location: ./");
                        exit;
                    }
                    if ($admin) {
                        //Je donne les valeurs du admin qui se connecte a SESSION
                        $_SESSION['email'] = $admin->getEmail();
                        $_SESSION['id'] = $admin->getIdAdmin();
                        $_SESSION['nom'] = $admin->getNom();
                        $_SESSION['prenom'] = $admin->getPrenom();
                        $_SESSION['role'] = "admin";
                        //je redirige vers le dashbord admin
                        header("Location: ./?path=admin&action=admin");
                        exit;
                    }
                }
            }
        }

        break;

    case "logout":
        // a verifier pour les SESSIONS existantant 
        if (!$_SESSION['erreur']) {
            session_unset();
            session_destroy();
        }


        header("Location: ./?path=main&action=home");
        break;

        //require("view/client/inscription.php");
        break;

        header('Location: ?path=main&action=nouveauMotsDePasse'); //echec
        break;

    case "formInscription":
        require("view/client/inscription.php");
        break;
    case "traitementInscription":
        //@todo 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // $errors = [];

            if (!empty($_POST)) {

                if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
                    header("Location: view/404.php");
                    exit();
                }
                if ($_POST["token"] == $_SESSION["token"]) {
                    if (isset($_POST['prenom'], $_POST['nom'], $_POST['adresse'], $_POST['ville'], $_POST['codepostal'], $_POST['email'], $_POST['mdp'], $_POST['mdp_confirm'])) {

                        $champVide = false;
                        $espace = false;
                        // $regCodePost = '/[0-9]{5}/';

                        foreach ($_POST as $cle => $valeur) {

                            if (empty($valeur)) {

                                $_SESSION["erreur"][$cle] = "les champ " . ucfirst($cle) . " est vide";
                                $champVide = true;
                            }

                            if (ctype_space($valeur)) {
                                $_SESSION["erreur"][$cle] = "Veuillez renseigner ce champs $cle";
                                $espace = true;
                            }
                        }

                        // 2 bis. Si un espace est dans les champs nom et prenom (message)
                        if ($champVide || $espace) {
                            header('Location:./?path=main&action=formInscription');
                        }

                        // 3. nettoyage de l'email
                        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

                        // 4. Supprime les espaces en début et fin de chaîne
                        $email = trim($email);

                        // 4. Validation de l'email
                        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                            $_SESSION["erreur"]["email"] = $email . " n'est pas valide";

                            header('Location:./?path=main&action=formInscription');
                            exit;
                        } else {
                            session_unset();
                        }
                        // 5. Validation Code Postal
                        if (filter_var($_POST['codepostal'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/[0-9]{5}/"))) === false) {
                            $_SESSION["erreur"]["codepostal"] = $_POST['codepostal'] . " n'est pas valide comme Code Postal";

                            header('Location:./?path=main&action=formInscription');
                            exit;
                        }

                        // Nettoyage
                        /* Je crée une boucle qui va générer DYNAMIQUEMENT les variables */

                        foreach ($_POST as $k => $v) {
                            if ($k != "email") {
                                $$k = filter_var($v, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                $$k = trim($$k);
                            }
                            if ($champVide || $espace) {
                                header('Location: ./?path=main&action=formInscription');
                                exit;
                            }
                        }

                        // Formatage du prénom et du nom
                        $prenom = ucfirst(strtolower($prenom));
                        $nom = strtoupper($nom);
                        $ville = ucfirst(strtolower($ville));

                        $regmdp = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@!#&])[A-Za-z\d@!#&]{8,}/";

                        $mdp = filter_var($_POST['mdp'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $mdp_confirm = filter_var($_POST['mdp_confirm'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                        if (!preg_match($regmdp, $mdp)) {
                            $_SESSION['erreur'] = 'le mot de passe n\'est pas au format attendut.';
                            header('Location: ./?path=main&action=formInscription');
                            exit;
                        }
                        $mdp = hash('sha256', $mdp);
                        $mdp_confirm = hash('sha256', $mdp_confirm);


                        if ($mdp != $mdp_confirm) {
                            $_SESSION['erreur'] = "Les mots de passe ne sont pas identiques.";
                        } else {
                            unset($_SESSION['erreur']);

                            $ogjClientManager = new ClientManager($lePDO);

                            $atrClient = new Client();

                            $atrClient->setPrenom($prenom);
                            $atrClient->setNom($nom);
                            $atrClient->setAdresse($adresse);
                            $atrClient->setVille($ville);
                            $atrClient->setCodePostal($codepostal);
                            $atrClient->setEmail($email);
                            $atrClient->setMdp($mdp);

                            $_SESSION['post']['inscritpion'] = "Votre inscritpion a bien été validée.";
                            // var_dump($atrClient);
                            // exit;
                            $ogjClientManager->addClient($atrClient);
                            header("Location: ./?path=main&action=formInscription");
                            exit;
                        }


                        // header('Location: view/traitement.php');
                        // exit;

                        //require 'view/traitement.php';
                    } else {
                        $_SESSION['erreur'] = 'post name n\'a pas etet declaré ou est null';
                    }
                }
            } else {
                $_SESSION['erreur'] = 'post est vide';
            }
        } else {
            $_SESSION['erreur'] = "Erreur de méthode.";
        }
        // header("Location: ./?path=main&action=formInscription");
        break;


    case "contact":
        require('view/contact.php');
        break;

    case "traitementContact":
        //var_dump($_POST);
        unset($_SESSION["erreur"]);
        foreach ($_POST as $index => $va) {
            $_SESSION["post"][$index] = $va;
        }
        // 1. Validation de la méthode d'envoi
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
                header("Location: view/404.php");
                exit();
            }

            if ($_POST["token"] == $_SESSION["token"]) {
                if (!empty($_POST)) {
                    if (isset($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['tel'], $_POST['message'])) {
                        $champVide = false;
                        // 2. Si le champ est vide ?  

                        $espace = false;
                        foreach ($_POST as $cle => $valeur) {

                            if (empty($valeur)) {

                                $_SESSION["erreur"][$cle] = "le champ " . ucfirst($cle) . " est vide";
                                $champVide = true;
                                // si une valeur a l'index 0 est une espace alors...   
                            }

                            if (ctype_space($valeur)) {
                                $_SESSION["erreur"][$cle] = "Veuillez renseigner ce champs $cle";
                                $espace = true;
                            }
                        }

                        // 2 bis. Si un espace est dans les champs nom et prenom (message)
                        if ($champVide || $espace) {
                            header('Location:./?path=main&action=contact');
                            exit;
                        }
                        // 3. nettoyage de l'email
                        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

                        // 4. Supprime les espaces en début et fin de chaîne
                        $email = trim($email);

                        // 4. Validation de l'email
                        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                            $_SESSION["erreur"]["email"] = $email . " n'est pas valide";

                            header('Location:./?path=main&action=contact');
                            exit;
                        } else {
                            session_unset();
                        }
                        // Nettoyage
                        /* Je crée une boucle qui va générer DYNAMIQUEMENT les variables */

                        foreach ($_POST as $k => $v) {

                            if ($k != "email") {
                                $$k = filter_var($v, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                $$k = trim($$k);
                            }

                            if ($champVide || $espace) {
                                header('Location: ./?path=main&action=contact');
                                exit;
                            }
                        }
                        // Formatage du prénom et du nom
                        $prenom = ucfirst(strtolower($prenom));
                        $nom = strtoupper($nom);

                        require './public/PHPMailer-master/src/Exception.php';
                        require './public/PHPMailer-master/src/PHPMailer.php';
                        require './public/PHPMailer-master/src/SMTP.php';

                        $mail = new PHPmailer();
                        $mail->IsSMTP();

                        // $mail->SMTPDebug = 2;
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 465;
                        $mail->SMTPSecure = 'tls';
                        //  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->SMTPAuth = true;
                        $mail->Username = "floriangtme@gmail.com"; //votre gmail
                        $mail->Password = "  "; // mdp gmail
                        $mail->SMTPSecure = 'ssl';
                        $mail->setFrom('floriangtme@gmail.com', 'Formulaire de contact'); // votre gmail
                        $mail->AddAddress($email);

                        $mail->IsHTML(true);
                        $mail->Subject = 'message de ' . $nom . ' email ' . $email;
                        $mail->Body = $message;
                        $mail->CharSet = "UTF-8";
                        if (!$mail->Send()) { //Teste le return code de la fonction
                            echo $mail->ErrorInfo; //Affiche le message d'erreur 
                        } else {
                            //echo 'Mail envoyé avec succès';
                        }
                        $mail->SmtpClose();
                        unset($mail);

                        $_SESSION['post']['valide'] = "Votre demande a bien été validée.";
                        // require 'view/traitement.php';
                        // exit;
                        // require 'view/contact.php';
                        header("Location: ?path=main&action=contact");
                    }
                }
            } else {
                header("Location: view/404.php");
                exit();
            }
        } else {
            die('erreur de méthode');
        }






        break;

    case 'traitement':
        require 'view/traitement.php';
        break;

    default:
        require('view/404.php');
}
