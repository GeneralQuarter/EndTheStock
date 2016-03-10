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
    
    function getPrixHorsTaxeString(){
        return preg_replace('~\.0+$~','',number_format($this->getPrixHorsTaxe(), 2, '.', ' '));
    }
    
    function getPrixHorsTaxe(){
        return unserialize($this->getProduit())->getPrix()*$this->quantitee;
    }
    
    function getPrixAvecTaxeString(){
        return preg_replace('~\.0+$~','',number_format($this->getPrixAvecTaxe(), 2, '.', ' '));
    }
    
    function getPrixAvecTaxe(){
        $produit = unserialize($this->getProduit());
        return $this->quantitee*$produit->getPrix()*((100+$produit->getTaxe())/100);
    }
}
