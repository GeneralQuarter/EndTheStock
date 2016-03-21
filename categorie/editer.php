<?php

include '../header.php';

if(!$isUserConnected) {
    header('Location: ../index.php');
}

if(!$isUserAdmin){
    header('Location: ../403.php?page=editerProduit.php');
}

if(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS) !== false){
    $nom = (string) filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
    if($isBD){
        $id = (int) filter_input(INPUT_POST, 'id');
        $categorie = new Categorie($id, $nom);
        if(!empty($categorie->getId())){
            if(!$bd->query("UPDATE CATEGORIE SET NOM_CATEGORIE='".$categorie->getNom()."' WHERE ID_CATEGORIE=".$categorie->getId())){
                //TODO Message d'erreur ?
                echo "Erreur d'update ". "UPDATE GATEGORIE SET NOM_CATEGORIE='".$categorie->getNom()."' WHERE ID_CATEGORIE=".$categorie->getId();
            }else header('Location: consulter.php');
        }else{
            if(!$bd->query("INSERT INTO CATEGORIE(NOM_CATEGORIE) VALUES ('".$categorie->getNom()."')")){
                //TODO Message d'erreur ?
                echo "Erreur d'insertion "."INSERT INTO CATEGORIE(NOM_CATEGORIE) VALUES ('".$categorie->getNom()."')";
            }else header('Location: consulter.php');
        }
    }
}

