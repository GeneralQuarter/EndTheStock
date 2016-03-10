<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commande
 *
 * @author administrateur
 */
class Commande {
    private $lignes = [];
    
    function __construct(){}
    
    function getLignes(){
        return $this->lignes;
    }
    
    function ajouterLigne($produit, $quantitee){
        $estPresent=false;
        /* @var $ligne LigneCommande*/
        for ($i=0 ; $i<count($this->lignes) ; $i++){
            $ligne = unserialize($this->lignes[$i]);
            if(unserialize($ligne->getProduit())->getId() == $produit->getId()){
                $ligne->setQuantitee($ligne->getQuantitee()+$quantitee);
                $estPresent = true;
                $this->lignes[$i] = serialize($ligne);
            }
        }
        
        if(!$estPresent){
            $this->lignes[] = serialize(new LigneCommande($quantitee, serialize($produit)));

        }
    }
}
