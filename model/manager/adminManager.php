<?php
//require './model/class/admin.class.php';

class AdminManager
{

    public function __construct($unPDO)
    {
        $this->lePDO = $unPDO;
    }
    /**
     * Va chercher tous les admin par leur ID 
     *
     * @param [int] $id
     * @return void
     */
    function fetchAdminById(int $id)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM admin WHERE idAdmin=:idAdmin ORDER BY nom");
            $sql->bindParam(":idAdmin", $id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Admin");
            $resultat = ($sql->fetch());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'function fetchAdminById';
        }
    }
    /**
     * Selectionne de la table admin la valeur ou emailTable et egale a emailParam idem pour mdp
     *
     * @param string $email
     * @param string $hashMdp
     * @return 
     */
    public function fetchAdminByEmailAndMdp(string $email, string $hashMdp)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM admin WHERE email=:email and mdp=:mdp");

            $sql->bindParam(":email", $email);
            $sql->bindParam(":mdp", $hashMdp);
            $sql->execute();

            $sql->setFetchMode(PDO::FETCH_CLASS, "Admin");
            $resultat = $sql->fetch();
            return $resultat;

        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo $error->getCode();
            echo 'Méthode fetchAdminByEmailAndMdp code error ';
        }
    }

    public function fetchAdminByEmail(string $email)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM admin WHERE email=:email");
            $sql->bindParam(":email", $email);
            $sql->execute();

            $sql->setFetchMode(PDO::FETCH_CLASS, "Admin");
            $resultat = $sql->fetch();
            return $resultat;

        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo $error->getCode();
            echo 'Méthode fetchAdminByEmail code error ';
        }
    }


}




// INSERT INTO `admin` (`idAdmin`, `nom`, `prenom`, `email`, `mdp`) VALUES (NULL, :idAdmin, :nom, :nom, :nom);
//
