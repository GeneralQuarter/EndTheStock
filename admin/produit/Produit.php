<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produit
 *
 * @author Quentin Gangler
 */
class Produit {
    private $id;
    private $nom;
    private $desc;
    private $categorieID;
    private $prix;
    private $taxe;
    private $urlImage;
    private $altImage;
    
    function __construct($id, $nom, $desc, $categorieID, $prix, $taxe, $urlImage, $altImage) {
        $this->id = $id;
        $this->nom = $nom;
        $this->desc = $desc;
        $this->categorieID = $categorieID;
        $this->prix = $prix;
        $this->taxe = $taxe;
        $this->urlImage = $urlImage;
        $this->altImage = $altImage;
    }
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getDesc() {
        return $this->desc;
    }

    function getCategorieID() {
        return $this->categorieID;
    }

    function getPrix() {
        return $this->prix;
    }

    function getTaxe() {
        return $this->taxe;
    }

    function getUrlImage() {
        return $this->urlImage;
    }

    function getAltImage() {
        return $this->altImage;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setDesc($desc) {
        $this->desc = $desc;
    }

    function setCategorieID($categorieID) {
        $this->categorieID = $categorieID;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setTaxe($taxe) {
        $this->taxe = $taxe;
    }

    function setUrlImage($urlImage) {
        $this->urlImage = $urlImage;
    }

    function setAltImage($altImage) {
        $this->altImage = $altImage;
    }


}
