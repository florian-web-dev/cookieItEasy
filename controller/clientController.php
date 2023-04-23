<?php

//TODO Verification Admin

// require_once 'model/manager/clientManager.php';
// require_once 'model/manager/articleManager.php';
// require_once 'model/manager/commandeManager.php';
if (!isset($_GET['action'])) {
    $action = "client";
} else {
    $action = $_GET['action'];
}

switch ($action) {

    case 'clientCommandes':
        //$objClientMana = new ClientManager($lePDO);

        $objCommandeMan = new CommandeManager($lePDO);
        $lesCommmandes = $objCommandeMan->fetchAllCommandebyIdClient($_SESSION['id']);

        $objArticleMana = new ArticleManager($lePDO);

        require("view/client/clientCommand.php");
        break;


    case "panier":
        //var_dump($_SESSION);
        $objArticle = new ArticleManager($lePDO);
        unset($_SESSION['succes']);

        require("view/client/panier.php");
        break;
    case "traitementAjoutPanier";

        if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
            header("Location: view/404.php");
            exit();
        }
        if ($_POST["token"] == $_SESSION["token"]) {

            $idArticle = filter_var($_POST['idArticle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $quantite = filter_var($_POST['quantite'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // token
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            } else {

                for ($i = 0; $i < count($_SESSION['panier']); $i++) {

                    if ($idArticle == $_SESSION['panier'][$i][0]) {

                        $quantite += $_SESSION['panier'][$i][1];

                        $_SESSION['panier'][$i][1] = $quantite;

                        header('Location: ./?path=client&action=panier');
                        exit;
                    }
                }
            }

            array_push($_SESSION['panier'], [$idArticle, $quantite]);

            header('Location: ./?path=client&action=panier');
        }

        break;

    case 'paniertraitemenTable':
        // echo $_SESSION['totalPanier'];
        // exit;
        if (!isset($_POST["token"]) || !isset($_SESSION["token"])) {
            header("Location: view/404.php");
            exit();
        }
        if ($_POST["token"] == $_SESSION["token"]) {
            $objCommandeMan = new CommandeManager($lePDO);
            $objCommandeMan->createCommande();
            $_SESSION['succes'] = 'Votre commande a bien été enregistrée.';
            header('Location: ./?path=main&action=home');
        }
        break;
    case 'panierReste':
        unset($_SESSION['succes']);
        unset($_SESSION['panier']);
        header('Location: ?path=client&action=panier');
        break;

    default:
        require('view/404.php');
}
