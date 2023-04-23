<?php
// require './model/class/commande.class.php';
// require './model/class/article_commande.class.php';

class CommandeManager
{
    public function __construct($unPDO)
    {
        $this->lePDO = $unPDO;
    }
    /**
     * Recupere toutes les commandes est les trie par etat SELECT * FROM commande ORDER by idComande
     *
     * @return 
     */
    function fetchAllCommande()
    {

        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM commande ORDER by idCommande ASC");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Commande");
            $resultat = ($sql->fetchAll());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function fetchAllCommande';
        }
    }

    /**
     * Recupere toutes les commandes est les trie par etat SELECT * FROM commande ORDER by etat
     *
     * @return 
     */
    function fetchAllCommandeByOrderEtat()
    {

        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM commande ORDER by etat");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Commande");
            $resultat = ($sql->fetchAll());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function fetchAllCommande';
        }
    }

    function fetchAllCommandebyIdClient(int $idClient)
    {

        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM commande WHERE idClient=:idClient ORDER BY commande.dateCommande DESC ");
            $sql->bindParam(":idClient", $idClient);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Commande");
            $resultat = ($sql->fetchAll());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function fetchAllCommande';
        }
    }



    // select prixUnitaire*quantite as prixTotal from article_commande natural join article
    
    function createCommande()
    {
        try {
            //idCommande     dateCommande     dateLivraison     etat     idClient 
            $connex = $this->lePDO;
            $connex->beginTransaction();
            $sql = $connex->prepare("INSERT INTO commande values(null,:dateCommande,null,'En cours',:idClient,:totalPanier)");
            $today = date("Y-m-d H:i:s");
            $sql->bindParam(":dateCommande", $today);
            $sql->bindValue(":idClient", $_SESSION['id']);
            $sql->bindValue(":totalPanier", $_SESSION['totalPanier']);
            $sql->execute();

            //idArticle     idCommande     quantiteArticle 
            $idCommande = $connex->lastInsertId();
            foreach ($_SESSION['panier'] as $uneLignePanier) {
                $sql = $connex->prepare("INSERT INTO article_commande values(:idArticle,:idCommande,:quantite)");

                $sql->bindParam(":idCommande", $idCommande);
                $sql->bindValue(":idArticle", $uneLignePanier[0]);
                $sql->bindValue(":quantite", $uneLignePanier[1]);
                $sql->execute();
            }
            $connex->commit();
        } catch (PDOException $error) {
            $connex->rollBack();
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function createCommande';
        }
    }

    public function deleteCommandeTrans(int $idCommande)
    {
        try {
            $connex = $this->lePDO;
            $connex->beginTransaction();
            $sql = $connex->prepare("DELETE FROM `article_commande` WHERE `idCommande`=:idCommande");
            $sql->bindParam(":idCommande", $idCommande);
            $sql->execute();
        
            $sql = $connex->prepare("DELETE FROM `commande` WHERE `idCommande`=:idCommande");
            $sql->bindParam(":idCommande", $idCommande);
            $sql->execute();

            $connex->commit();
        } catch (PDOException $error) {
            $connex->rollBack();
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'Methode deleteCommandeTrans';
        }
      
    }


   /**
    * Recupere toutes les commandes par leur ID
    *
    * @param integer $idCommande
    * @return 
    */
    function fetchAllCommandebyId(int $idCommande)
    {

        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM article_commande WHERE idCommande=:idCommande ");
            $sql->bindParam(":idCommande", $idCommande);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Article_commande");
            $resultat = ($sql->fetchAll());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function fetchAllCommande';
        }
    }

    // function fetchSumCommandebyIdCommand(int $idCommande)
    // {

    //     try {
    //         $connex = $this->lePDO;
    //         $sql = $connex->prepare("SELECT SUM(`quantiteArticle`) FROM `article_commande` WHERE idCommande=:idCommande ");
    //         $sql->bindParam(":idCommande", $idCommande);
    //         $sql->execute();
    //         $sql->setFetchMode(PDO::FETCH_CLASS, "Article_commande");
    //         $resultat = ($sql->fetchAll());
    //         return $resultat;
    //     } catch (PDOException $error) {
    //         echo "Fichier : " . $error->getFile() . "<br>";
    //         echo "Ligne : " . $error->getLine() . "<br>";
    //         echo $error->getMessage()  . "<br>";
    //         echo "code error : " . $error->getCode() . "<br>";
    //         echo 'function fetchSumCommandebyIdCommand';
    //     }
    // }



}
