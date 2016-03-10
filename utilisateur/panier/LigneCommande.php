<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        $this->produit = $produit;
    }
    
    function getQuantitee() {
        return $this->quantitee;
    }
    
    function getProduit() {
        return $this->produit;
    }

    function setQuantitee($quantitee) {
        $this->quantitee = $quantitee;
    }
    
    function setProduit($produit) {
        $this->produit = $produit;
    }
}
