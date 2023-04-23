<?php
class Article_commande{
    private $idArticle;
    private $idCommande;
    private $quantiteArticle;
    private $totalCommand;
    

    /**
     * Get the value of idArticle
     */ 
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set the value of idArticle
     *
     * @return  self
     */ 
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    /**
     * Get the value of idCommande
     */ 
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * Set the value of idCommande
     *
     * @return  self
     */ 
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    /**
     * Get the value of quantiteArticle
     */ 
    public function getQuantiteArticle()
    {
        return $this->quantiteArticle;
    }

    /**
     * Set the value of quantiteArticle
     *
     * @return  self
     */ 
    public function setQuantiteArticle($quantiteArticle)
    {
        $this->quantiteArticle = $quantiteArticle;

        return $this;
    }

    /**
     * Get the value of totalCommand
     */ 
    public function getTotalCommand()
    {
        return $this->totalCommand;
    }

    /**
     * Set the value of totalCommand
     *
     * @return  self
     */ 
    public function setTotalCommand($totalCommand)
    {
        $this->totalCommand = $totalCommand;

        return $this;
    }
}