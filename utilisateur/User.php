<?php

class User {
    private $id;
    private $nom;
    private $prenom;
    private $pseudo;
    private $role;
    private $adresse_id;
    private $mdp;
    private $courriel;
    private $telephone;

    function __construct($pseudo, $mdp) {
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
    }
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getPseudo() {
        return $this->pseudo;
    }

    function getRole() {
        return $this->role;
    }

    function getAdresse_id() {
        return $this->adresse_id;
    }

    function getMdp() {
        return $this->mdp;
    }

    function getCourriel() {
        return $this->courriel;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function setAdresse_id($adresse_id) {
        $this->adresse_id = $adresse_id;
    }

    function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    function setCourriel($courriel) {
        $this->courriel = $courriel;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }


}

