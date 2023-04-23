<?php
session_start();
//require_once 'model/manager/categorieManager.php';
require("model/bdd.php");
$lePDO = etablirCo();


if (!isset($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(random_bytes(32));
}
/**
 * spl_autoload_register permet d'enregister une fonction qui tentera le chargement d'une Classe
 */
spl_autoload_register(function ($class_name) {
    //echo getType($class_name);
    if(strpos($class_name,"Manager"))
    {
            include "model/manager/".$class_name . '.php';
    }
    else {
        $fichier=strtolower($class_name);
        include "model/class/".$fichier . '.class.php';
    }
});


$laCategorieManager = new CategorieManager($lePDO);
$lesCategories = $laCategorieManager->fetchAllCategorie();

if (!isset($_GET['path'])) {
    $path = "main";
} else {
    $path = $_GET['path'];
}
switch ($path) {
    case "main":
        require('controller/controller.php');
        break;
    case "client":
        if (empty($_SESSION['role']) || $_SESSION['role'] != "client") {

            header("Location: ./?path=main&action=formLogin");
        } else {
            require('controller/clientController.php');
        }
        break;
    case "admin":
        if (empty($_SESSION['role']) )
        {
            require("view/403.php");
        }
        elseif($_SESSION['role']=="admin")
        {
       
        require('controller/adminController.php');
        }
        else{
            require("view/403.php");
        }
        break;
    default:
        require("view/404.php");
}



