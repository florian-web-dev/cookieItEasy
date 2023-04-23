<?php
// require_once("model/class/categorie.class.php");


class CategorieManager
{
    private $lePDO;

    public function __construct($unPDO)
    {
        $this->lePDO = $unPDO;
    }

    function fetchAllCategorie()
    {

        try {
            //Pour la co on utilise l'attribut lePDO
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM categorie ORDER BY idCategorie");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Categorie");
            $resultat = ($sql->fetchAll());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode(). "<br>" ;
            echo 'function fetchAllCategorie ';
        }
    }

    /**
     *Permet de recuperer une categorie par son id
     *
     * @param int $id l'id de la categorie
     * @return array la categorie sous la forme d'un objet
     */
    function fetchCategorieById(int $id)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM categorie WHERE idCategorie=:idCategorie");
            $sql->bindParam(":idCategorie", $id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Categorie");
            $resultat = ($sql->fetch());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode(). "<br>" ;
            echo 'function fetchCategorieById';
        }
    }

/**
 * Ajoute une catégorie
 *
 * @param string $nom
 * @return void
 */
    function addCategorie(string $nom){
        try {
            $connex= $this->lePDO;
            $sql =$connex->prepare("INSERT INTO categorie values(null,:nom)");
            $sql->bindValue(":nom",$nom );
            
            $sql->execute();

        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo $error->getCode() ;
            echo 'Methode addCategorie code error ';
        }
    }

/**
 * Modifie le nom d'une categorie 
 *
 * @param string $nom
 * @param integer $idCategorie
 * @return 
 */
    function uptdateCategorie(string $nom,int $idCategorie){
        try {
            $connex= $this->lePDO;
            $sql = $connex->prepare("UPDATE categorie SET nom=:nom WHERE idCategorie=:idCategorie");
            $sql->bindValue(":nom",$nom );
            $sql->bindValue(":idCategorie",$idCategorie );
            $sql->execute();

        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo $error->getCode() ;
            echo 'Methode uptdateCategorie code error ';
        }
    }
    /**
     * Suprime une catéorie
     *
     * @param integer $idCategorie
     * @return void
     */
    function supCategorie(int $idCategorie){
        try{
            $connex = $this->lePDO;
            $sql = $connex->prepare("DELETE FROM categorie WHERE idCategorie=:idCategorie");
            $sql->bindValue(":idCategorie",$idCategorie);
            $sql->execute();
        }catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo $error->getCode() ;
            echo 'Methode uptdateCategorie code error ';
        }
    }

}


