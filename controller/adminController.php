<?php
// require './model/manager/articleManager.php';
// require_once './model/manager/commandeManager.php';
// require_once './model/manager/clientManager.php';
// require_once './model/manager/categorieManager.php';


// $regEmail = '/[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})/';


if (!isset($_GET['action'])) {
    $action = "admin";
} else {
    $action = $_GET['action'];
}

switch ($action) {
    case "admin":
        unset($_SESSION['msg']);
        require('view/admin/admin.php');
        break;

    case "article":
        $articleAdmin = new ArticleManager($lePDO);
        $lesArticles = $articleAdmin->fetchAllArticle();
        require('view/admin/article.php');
        break;

    case "adminArticle":
        //@todo Recuperer les articles
        $articleAdmin = new ArticleManager($lePDO);
        $lesArticles = $articleAdmin->fetchAllArticle();
        //var_dump($lesArticles);

        require("view/admin/adminArticle.php");
        break;

    case "formAjoutArticle":
        $objCategoriManager = new CategorieManager($lePDO);
        $lesCategorie = $objCategoriManager->fetchAllCategorie();

        require('view/admin/formAddArticle.php');
        break;

    case "traitementAjoutArticle":
        // $adminSession = $_SESSION['admin'];
        //var_dump($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['nom'], $_POST['description'], $_POST['prix'], $_POST['idCategorie'])) {

                if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
                    header("Location: view/404.php");
                    exit();
                }
                if ($_POST["token"] == $_SESSION["token"]) {
                    $varEstDispo = 0;
                    if (isset($_POST['estDispo'])) {
                        $varEstDispo = 1;
                        $varEstDispo = intval($varEstDispo);
                        //var_dump($varEstDispo);
                    }

                    $champNonValide = false;
                    $formRemplie = true;

                    foreach ($_POST as $key => $value) {

                        if (empty($value)) {

                            $_SESSION['error'] = "Ce champ est requis";

                            $champNonValide = true;
                            $formRemplie = false;

                        }

                        if (ctype_space($value)) {
                            $_SESSION["error"] = "Veuillez renseigner ce champs $key";
                            $champNonValide = true;
                        } else {
                            unset($_SESSION['error']);
                        }
                    }
        
                    $prix = floatval($_POST['prix']);
            
                    $idCategori = intval($_POST['idCategorie']);

                    $nom = filter_var($_POST['nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $desciption = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $prix = filter_var($_POST['prix'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $idCategori = filter_var($_POST['idCategorie'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $nom = trim($nom);
                    $desciption = trim($desciption);
                    $prix = trim($prix);
                    $idCategori = trim($idCategori);


                    $nom = ucfirst($nom);
                    $desciption = ucfirst($desciption);
           

                    if ($champNonValide != true && $formRemplie != false) {


                        $objArticle = new Article();

                        $objArticle->setNom($nom);
                        $objArticle->setDescription($desciption);
                        $objArticle->setPrixUnitaire($prix);
                        $objArticle->setEstDisponible($varEstDispo);
                        $objArticle->setIdCategorie($idCategori);

                        $objAddArticle = new ArticleManager($lePDO);

                        $objAddArticle->addArticleMan($objArticle);

                        $_SESSION['msg'] = 'Article ajouter ' . $nom;
                    } else {
                        $_SESSION["error"] = "champNonValide . $champNonValide . ' ' . 'formRemplie' . $formRemplie";

                    }
                }
            } else {
                $_SESSION['error'] = "Un des champ est vide Les post sont soit vide soit null";
            }
        } else {
            echo ' la methode Post n\'exite pas';
        }

     
        header('Location:?path=admin&action=adminArticle');

        break;


    case "formModifArticle":
        $objCategoriManager = new CategorieManager($lePDO);
        $lesCategorie = $objCategoriManager->fetchAllCategorie();

        $theid = filter_var($_GET['idArticle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ogjArticle = new articleManager($lePDO);
        $idArticles = $ogjArticle->fetchByIdArticle($theid);

        require('view/admin/formModifArticle.php');
        break;


    case "traitementFormModifArcticle":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (isset($_POST['description'], $_POST['estDispo'], $_POST['prix'], $_POST['idCategorie'], $_GET['idArticle'])) {


                if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
                    header("Location: view/404.php");
                    exit();
                }
                if ($_POST["token"] == $_SESSION["token"]) {
                    $champNonValide = false;
                    $formRemplie = true;
                    //var_dump($_POST);


                    foreach ($_POST as $key => $value) {

                        if (empty($value)) {

                            $_SESSION['error'][$key] = "Ce champ est requis";
                            //echo $_SESSION['error'][$key];

                            $champNonValide = true;
                            $formRemplie = false;


                        }

                        if (ctype_space($value)) {
                            $_SESSION["erreur"]['$key'] = "Veuillez renseigner ce champs $key";
                            $champNonValide = true;
                            //echo $_SESSION["erreur"]['$key'];
                        } else {
                            unset($_SESSION['error']);
                        }
                    }

                    $idCategori = intval($_POST['idCategorie']);
                    $prix = floatval($_POST['prix']);

                    $desciption = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $prix = filter_var($_POST['prix'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $idCategori = filter_var($_POST['idCategorie'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                    $desciption = trim($desciption);
                    $prix = trim($prix);
                    $idCategori = trim($idCategori);

                    $varEstDispo = filter_var($_POST['estDispo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $desciption = ucfirst($desciption);

                    $theId = filter_var($_GET['idArticle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


                    if ($champNonValide != true && $formRemplie != false) {


                        $objArticle = new Article;

                        $objArticle->setIdArticle($theId);
                        $objArticle->setDescription($desciption);
                        $objArticle->setPrixUnitaire($prix);
                        $objArticle->setIdCategorie($idCategori);
                        $objArticle->setEstDisponible($varEstDispo);


                        $objManager = new ArticleManager($lePDO);

                        $objManager->updapteArticleMan($objArticle);


                        $_SESSION['msg'] = 'Article modifier ';
                    } else {
                        $_SESSION["erreur"] = "champNonValide . $champNonValide . ' ' . 'formRemplie' . $formRemplie";
                    }
                }
            } else {
                $_SESSION['error'] = "un des post est vide";
            }
        } else {
            $_SESSION['error'] = "erreur de requete";
        }



        header('Location: ?path=admin&action=adminArticle');
        break;

    case "supprimerArticle":
        if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
            header("Location: view/404.php");
            exit();
        }
        if ($_POST["token"] == $_SESSION["token"]) {

            $id = filter_var($_POST['idArticle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $objArticlMana = new ArticleManager($lePDO);
            $objArticlMana->deleteArticleByIdArticle($id);
            $_SESSION['msg'] = "L'article a été suprimé";
            header('Location: ?path=admin&action=adminArticle');
        }

        break;

    case "Commande":
        $objCommandeMana = new CommandeManager($lePDO);
        $lesCommandes = $objCommandeMana->fetchAllCommande();

        $objClientMana = new ClientManager($lePDO);

        $articleManager = new ArticleManager($lePDO);

        require('view/admin/admiCommande.php');
        break;
    case 'modiCommande':
        $objCommandeMana = new CommandeManager($lePDO);
        $lesCommandes = $objCommandeMana->fetchAllCommande();

        $objClientMana = new ClientManager($lePDO);

        $articleManager = new ArticleManager($lePDO);
        require 'view/admin/admiModifCommande.php';
        break;

    case 'supprimerCommande':

        if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
            header("Location: view/404.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST["token"] == $_SESSION["token"]) {
                if (isset($_POST['idCommande'])) {

                    $idCommande = filter_var($_POST['idCommande'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $objCommandeMana = new CommandeManager($lePDO);
                    $objCommandeMana->deleteCommandeTrans($idCommande);
                    header('Location:?path=admin&action=modiCommande');
                }
            }
        }



        break;

    case 'modiCommandetraitement':

        var_dump($_POST);
        exit;

        header('Location:?path=admin&action=modiCommande');
        break;

    case 'client':
        $objClientMana = new ClientManager($lePDO);
        $lesClient = $objClientMana->fetchAllClient();
        require('view/admin/client.php');
        break;

    case 'gereCategorie':

        $objcategoriMana = new CategorieManager($lePDO);
        $lesCategories = $objcategoriMana->fetchAllCategorie();


        require('view/admin/gererCategorie.php');
        break;
    case 'traitementAddCategorie':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['addCategorie'])) {
                $addCategorie = filter_var($_POST['addCategorie'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if (empty($addCategorie) && ctype_space($addCategorie)) {
                    $_SESSION['msg'] = 'le champs est vide';
                    header('Location: ?path=admin&action=gereCategorie');
                    exit;
                } else {
                    unset($_SESSION['msg']);
                    $addCategorie = trim($addCategorie);
                    $addCategorie = ucfirst($addCategorie);

                    $objCategorieMana = new CategorieManager($lePDO);
                    $objCategorieMana->addCategorie($addCategorie);

                    $_SESSION['msg'] = 'Une catégorie a été ajoutée.';
                    header('Location: ?path=admin&action=gereCategorie');
                }
            }
        }
        break;

    case 'modifierCategorie':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['modifCategorie'])) {
                $modifCategorie = filter_var($_POST['modifCategorie'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $idCategori = filter_var($_POST['idCategorie'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if (empty($modifCategorie) || ctype_space($modifCategorie)) {
                    $_SESSION['msg'] = 'le champs est vide';
                    header('Location: ?path=admin&action=gereCategorie');
                    exit;
                } else {
                    unset($_SESSION['msg']);
                    $modifCategorie = trim($modifCategorie);
                    $modifCategorie = ucfirst($modifCategorie);


                    $objCatModifMana = new CategorieManager($lePDO);

                    $objCatModifMana->uptdateCategorie($modifCategorie, $idCategori);


                    $_SESSION['msg'] = 'La catégorie a été modifier';
                    header('Location: ?path=admin&action=gereCategorie');
                }
            }
        }

        header('Location: ?path=admin&action=gereCategorie');

        break;

    case 'supprimerCategorie':


        if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
            header("Location: view/404.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST["token"] == $_SESSION["token"]) {
                if (isset($_POST['idCategorie'])) {

                    $idCategorie = filter_var($_POST['idCategorie'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $objCategMana = new CategorieManager($lePDO);
                    $objCategMana->supCategorie($idCategorie);
                    $_SESSION['msg'] = "La catégorie a été suprimé";
                    header('Location: ?path=admin&action=gereCategorie');
                    exit;
                }
            }
        }



        break;


    default:
        require('view/404.php');
}
