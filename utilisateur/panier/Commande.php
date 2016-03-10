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
    
    function getNombreArticles(){
        $nombre = 0;
        /* @var $ligne LigneCommande*/
        foreach($this->lignes as $ligne){
            $ligne = unserialize($ligne);
            $nombre+=$ligne->getQuantitee();
        }
        return $nombre;
    }
    
    function getPrixHorsTaxeString(){
        $total = 0;
        /* @var $ligne LigneCommande*/
        foreach($this->lignes as $ligne){
            $ligne = unserialize($ligne);
            $total += $ligne->getPrixHorsTaxe();
        }
        
        return preg_replace('~\.0+$~','',number_format($total, 2, '.', ' '));
    }
    
    function getPrixAvecTaxeString(){
        $total = 0;
        /* @var $ligne LigneCommande*/
        foreach($this->lignes as $ligne){
            $ligne = unserialize($ligne);
            $total += $ligne->getPrixAvecTaxe();
        }
        
        return preg_replace('~\.0+$~','',number_format($total, 2, '.', ' '));
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
