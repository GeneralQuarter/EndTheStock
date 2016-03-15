<?php

include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../index.php');
}

if(!$isUserAdmin){
    header('Location: ../../accesRestraint.php?page=categorie/editer.php');
}

if(filter_input(INPUT_GET, 'id') !== false){
    $id = (int) filter_input(INPUT_GET, 'id');
    if($isBD && $id > 0){
        if(!$bd->query("DELETE FROM CATEGORIE WHERE ID_CATEGORIE=".$id)){
            //TODO Message d'erreur ?
            echo 'Erreur de suppression de l\'utilisateur ' . $id;
        }else{
            header('Location: consulter.php');
        }
    }
}

