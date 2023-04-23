<?php


/**
 * Function qui permet d'établir la co a la BDD 
 * retourne la connexion
 */
function etablirCo()
{
    $urlSGBD="localhost"; //nom de domaine pour un site distant
    $nomBDD="foodeasyhome"; // le nom de la BDD
    
    $loginBDD="Chamalow"; // login de connexion
    $mdpBDD="ShopAdmin!";// le mdp est root si on utilise Mamp
    $dsn = "mysql:host=$urlSGBD;dbname=$nomBDD"; //data source name
    try{
        //j'instancie la classe PDO et je lui rentre en parametre le dsn ainsi que le login et le mots de passe
    $connex = new PDO($dsn, "$loginBDD", "$mdpBDD", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $connex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $error) {
        echo $error->getMessage();
        echo $error->getCode() ;
    }
    return $connex;
}           


?>