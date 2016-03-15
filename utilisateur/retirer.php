<?php

include '../session.php';
include '../bd/BD.php';

if(!$isUserAdmin){
    header('Location: ../accesRestraint.php?page=utilisateur/retirer.php');
}

$id = filter_input(INPUT_GET, 'id');
if($id > 0){
    if($isBD){
        if(!$bd->query("DELETE FROM UTILISATEUR WHERE ID_UTILISATEUR=".$id)){
            echo 'Erreur de suppression de l\'utilisateur ' . $id;
        }else{
            header('Location: consulter.php');
        }
    }
}else{
    header('../');
}

