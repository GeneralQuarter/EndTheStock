<?php

include '../session.php';
include '../bd/BD.php';

if(!$isUserAdmin){
    header('Location: ../accesRestraint.php?page=utilisateur/retirer.php');
}

if(isset($_GET['id'])){
    if($isBD){
        if(!$bd->query("DELETE FROM UTILISATEUR WHERE ID_UTILISATEUR=".$_GET[id])){
            echo 'Erreur de suppression de l\'utilisateur ' . $_GET['id'];
        }else{
            header('Location: ../consulter.php');
        }
    }
}

