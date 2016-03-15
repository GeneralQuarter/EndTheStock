<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommandeEffectuee
 *
 * @author administrateur
 */
class CommandeEffectuee {
    private $idCommande;
    private $dateCommande;
    
    function __construct($id , $date){
        $this->idCommande = $id;
        $this->dateCommande = $date;
    }
    
    function getId(){
        return $this->idCommande;
    }
    
    function getDate(){
        return $this->dateCommande;
    }
}
