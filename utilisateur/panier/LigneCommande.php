<?php


/**
 * Description of LigneCommande
 *
 * @author administrateur
 */
class LigneCommande {
    private $quantitee;
    private $produit;
    
    function __construct($quantitee, $produit){
        $this->quantitee = $quantitee;
        $this->produit = serialize($produit);
    }
    
    function getQuantitee() {
        return $this->quantitee;
    }
    
    function getProduit() {
        return unserialize($this->produit);
    }

    function setQuantitee($quantitee) {
        $this->quantitee = $quantitee;
    }
    
    function setProduit($produit) {
        $this->produit = serialize($produit);
    }
}
