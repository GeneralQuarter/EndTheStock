<?php

include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../index.php');
}

if(!$isUserAdmin){
    header('Location: ../../accesRestraint.php?page=categorie/editer.php');
}

if(isset($_GET['id'])){
    if($isBD){
        if(!$bd->query("DELETE FROM CATEGORIE WHERE ID_CATEGORIE=".$_GET[id])){
            echo 'Erreur de suppression de l\'utilisateur ' . $_GET['id'];
        }else{
            header('Location: consulter.php');
        }
    }
}

