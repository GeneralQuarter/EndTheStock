<?php
class Adresse {
    private $id;
    private $numero_civique;
    private $rue;
    private $ville;
    private $departement;
    private $region;
    private $pays;
    
    function __construct($id, $numero_civique, $rue, $ville, $departement, $region, $pays) {
        $this->id = $id;
        $this->numero_civique = $numero_civique;
        $this->rue = $rue;
        $this->ville = $ville;
        $this->departement = $departement;
        $this->region = $region;
        $this->pays = $pays;
    }
    
    function getId() {
        return $this->id;
    }

    function getNumero_civique() {
        return $this->numero_civique;
    }
    
    function getRue() {
        return $this->rue;
    }
    
    function getVille() {
        return $this->ville;
    }
    
    function getDepartement() {
        return $this->departement;
    }
    
    function getRegion() {
        return $this->region;
    }
    
    function getPays() {
        return $this->pays;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumero_civique($numero_civique) {
        $this->numero_civique = $numero_civique;
    }
    
    function setRue($rue) {
        $this->rue = $rue;
    }
    
    function setVille($ville) {
        $this->ville = $ville;
    }
    
    function setDepartement($departement) {
        $this->departement = $departement;
    }
    
    function setRegion($region) {
        $this->region = $region;
    }
    
    function setPays($pays) {
        $this->pays = $pays;
    }
}
?>

