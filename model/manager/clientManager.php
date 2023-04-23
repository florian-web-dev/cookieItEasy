<?php

// require './model/class/client.class.php';

class ClientManager
{

    private $lePDO;

    public function __construct($unPDO)
    {
        $this->lePDO = $unPDO;
    }
    /**
     * Recurpe un client par sont email et sont mot de passe
     *
     * @param string $email
     * @param string $hashMdp
     * @return 
     */
    public function fetchClientByEmailAndMdp(string $email, string $hashMdp)
{
        try{
       
        $connex=$this->lePDO;
        $sql=$connex->prepare("SELECT * FROM client where email=:email and mdp=:mdp");
        
        $sql->bindParam(":email",$email);
        $sql->bindParam(":mdp",$hashMdp);
        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_CLASS,"Client");
        $resultat=$sql->fetch();
        return $resultat;

    }catch (PDOException $error) {
        echo "Fichier : " . $error->getFile() . "<br>";
        echo "Ligne : " . $error->getLine() . "<br>";
        echo $error->getMessage()  . "<br>";
        echo $error->getCode() ;
        echo 'Methode fetchClientByEmailAndMdp code error ';
    }
} 
    public function fetchClientByEmail(string $email)
{
        try{
        $connex=$this->lePDO;
        $sql=$connex->prepare("SELECT * FROM client where email=:email ");
        
        $sql->bindParam(":email",$email);
        
        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_CLASS,"Client");
        $resultat=$sql->fetch();
        return $resultat;

    }catch (PDOException $error) {
        echo "Fichier : " . $error->getFile() . "<br>";
        echo "Ligne : " . $error->getLine() . "<br>";
        echo $error->getMessage()  . "<br>";
        echo $error->getCode() ;
        echo 'Methode fetchClientByEmail code error ';
    }
}
    /**
     * Ajoute un client 
     *
     * @param [Objet] $objetClient class
     * @return void
     */
    function addClient(Client $objetClient){
        try {
            $connex= $this->lePDO;
            $sql =$connex->prepare("INSERT INTO client(prenom,nom,email,mdp,adresse,ville,codePostal) values(:prenom,:nom,:email,:mdp,:adresse,:ville,:codePostal)");
            $sql->bindValue(":prenom",$objetClient->getPrenom() );
            $sql->bindValue(":nom",$objetClient->getNom() );
            $sql->bindValue(":email",$objetClient->getEmail() );
            $sql->bindValue(":mdp",$objetClient->getMdp() );
            $sql->bindValue(":adresse",$objetClient->getAdresse() );
            $sql->bindValue(":ville",$objetClient->getVille() );
            $sql->bindValue(":codePostal",$objetClient->getCodePostal() );
            $sql->execute();
      

        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo $error->getCode() ;
            echo 'Methode addClient code error ';
        }
    }

        /**
     * Va chercher tous les client par leur ID 
     *
     * @param int $id
     * @return void
     */
    function fetchClientById(int $id)
    {
        try {
            $connex = $this->lePDO;
            $sql = $connex->prepare("SELECT * FROM client WHERE idClient=:idClient");
            $sql->bindParam(":idClient", $id);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_CLASS, "Client");
            $resultat = ($sql->fetch());
            return $resultat;
        } catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo "code error : " . $error->getCode() . "<br>";
            echo 'Methode fetchClientById';
        }
    }

    public function fetchAllClient()
    {
            try{
           
            $connex=$this->lePDO;
            $sql=$connex->prepare("SELECT * FROM client ORDER BY nom ASC");
            
            $sql->execute();
    
            $sql->setFetchMode(PDO::FETCH_CLASS,"Client");
            $resultat=$sql->fetchAll();
            return $resultat;
    
        }catch (PDOException $error) {
            echo "Fichier : " . $error->getFile() . "<br>";
            echo "Ligne : " . $error->getLine() . "<br>";
            echo $error->getMessage()  . "<br>";
            echo $error->getCode() ;
            echo 'Methode fetchAllClient code error ';
        }
    }



    
}

    