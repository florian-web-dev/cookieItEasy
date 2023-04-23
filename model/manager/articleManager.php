<?php


// require_once("model/class/article.class.php");

class ArticleManager
{
    private $lePDO;

    public function __construct($unPDO)
    {
        $this->lePDO = $unPDO;
    }
    /**
     * Permet de recuperer tout les articles d'une categorie (par son id)
     * @param [int] $idCate
     * @return array un array a deux dimensions
     */
    public function fetchAllArticleByIdCateg(int $idCate)
    {

        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM article WHERE idCategorie=:idCategorie ORDER BY nom");
            $sql->bindParam(":idCategorie", $idCate);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Article");
            $resultat = ($sql->fetchAll());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function fetchAllArticleByIdCateg';
        }
    }

    /**
     * Function qui recuperer les articles d'une categorie (par son id) avec un limit d'article en parametre
     *
     * @param integer $idCate
     * @param integer $nbrLimitArticle
     * @return objet qui contient les donneés des articles
     */
    function fetchArticleByCatLimite(int $idCate, int $nbrLimitArticle = null)
    {

        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM article WHERE idCategorie=:idCategorie ORDER BY nom LIMIT :nbr");
            $sql->bindParam(":idCategorie", $idCate);
            $sql->bindParam(":nbr", $nbrLimitArticle, PDO::PARAM_INT);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Article");
            $resultat = ($sql->fetchAll());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function fetchArticleByCatLimite ';
        }
    }

    function fetchAllArticle()
    {

        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM article");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Article");
            $resultat = ($sql->fetchAll());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function fetchAllArticle ';
        }
    }
    
    function fetchByIdArticle($id)
    {

        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM article WHERE idArticle=:idArticle ORDER BY nom");
            $sql->bindParam(":idArticle", $id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Article");
            $resultat = ($sql->fetch());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function fetchByIdArticle';
        }
    }

    function addArticleMan(Article $objArticle)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("INSERT INTO article values(null,:nom,:description,:prix,:estDisponible,:idCateg)");
            $sql->bindValue(":nom",$objArticle->getNom() );
            $sql->bindValue(":description",$objArticle->getDescription() );
            $sql->bindValue(":prix",$objArticle->getPrixUnitaire() );
            $sql->bindValue(":estDisponible",$objArticle->getEstDisponible() );
            $sql->bindValue(":idCateg",$objArticle->getIdCategorie() );
            $sql->execute();
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'Methode addArticleMan';
        }
    }

    // doit etre instancier avant d'etre utiliser 

    // function addArticleMan($objetArticle){
    //     try {
    //         $connex= $this->lePDO;;
    //         $sql =$connex->prepare("INSERT INTO article values(null,:nom,:description,:prix,:estDisponible,:idCateg,1)");
    //         $sql->bindValue(":nom",$objetArticle->getNom() );
    //         $sql->bindValue(":description",$objetArticle->getDescription() );
    //         $sql->bindValue(":prix",$objetArticle->getPrixUnitaire() );
    //         $sql->bindValue(":idCateg",$objetArticle->getIdCategorie() );
    //         $sql->bindValue(":estDisponible",$objetArticle->getEstDisponible() );
    //         $sql->execute();


    //     } catch (PDOException $error) {
    //         echo "Fichier : " . $error->getFile() . "<br>";
    //         echo "Ligne : " . $error->getLine() . "<br>";
    //         echo $error->getMessage()  . "<br>";
    //         echo $error->getCode() ;
    //         echo 'function addArticleMan code error ';
    //     }
    // }


    /**
     * Crée un article 
     *
     * @param string $nom
     * @param string $description
     * @param float $prix
     * @param integer $dispo
     * @param integer $fragile
     * @param integer $idCateg
     * @return void
     */
    // function createArticle(string $nom,string $description,float $prix,int $dispo,int $fragile,int $idCateg){
    //     try {
    //         $connex= $this->lePDO;;
    //         $sql =$connex->prepare("INSERT INTO article values(null,:nom,:description,:prix,:dispo,:idCateg,:fragile)");
    //         $sql->bindParam(":nom",$nom);
    //         $sql->bindParam(":description",$description);
    //         $sql->bindParam(":prix",$prix);
    //         $sql->bindParam(":dispo",$dispo);
    //         $sql->bindParam(":idCateg",$idCateg);
    //         $sql->bindParam(":fragile",$fragile);
    //         $sql->execute();


    //     } catch (PDOException $error) {
    //         echo "Fichier : " . $error->getFile() . "<br>";
    //         echo "Ligne : " . $error->getLine() . "<br>";
    //         echo $error->getMessage()  . "<br>";
    //         echo "code error : " . $error->getCode(). "<br>" ;
    //         echo 'function createArticle';
    //     }
    // }
    /**
     * Modifie un article ( ne permet pas de modifier le nom )
     *
     * @param Article $objetArticle
     * @return void
     */
    function updapteArticleMan(Article $objetArticle)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("UPDATE article SET description=:description,prixUnitaire=:prix,estDisponible=:estDisponible,idCategorie=:idCateg WHERE idArticle=:idArticle");
            $sql->bindValue(":description", $objetArticle->getDescription());
            $sql->bindValue(":prix", $objetArticle->getPrixUnitaire());
            $sql->bindValue(":estDisponible", $objetArticle->getEstDisponible());
            $sql->bindValue(":idCateg", $objetArticle->getIdCategorie());
            $sql->bindValue(":idArticle", $objetArticle->getIdArticle()); //,PDO::PARAM_INT
            $sql->execute();

        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo $error->getCode();
            echo 'function updapteArticleMan code error ';
        }
    }

    public function deleteArticleByIdarticle($id)
    {
        try {
            $connex = $this->lePDO;
            $connex->beginTransaction();

            $sql = $connex->prepare("DELETE from article_commande where idArticle=:id");
            $sql->bindParam(":id", $id);
            $sql->execute();

            $sql2 = $connex->prepare("DELETE from article where idArticle =:id");
            $sql2->bindParam(":id", $id);
            $sql2->execute();

            $connex->commit();
        } catch (PDOException $error) {
            $connex->rollBack();
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo $error->getCode();
            echo 'function deleteArticleByIdArticle code error ';
        }
    }
}
