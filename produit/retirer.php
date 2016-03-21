<?php

include '../header.php';

if(!$isUserConnected) {
    header('Location: ../index.php');
}

if(!$isUserAdmin){
    header('Location: ../403.php?page=editerProduit.php');
}

if(filter_input(INPUT_GET, 'id') !== false){
    $id = (int) filter_input(INPUT_GET, 'id');
    if($id > 0){
        if($isBD){
            if(!$bd->query("UPDATE PRODUIT SET VISIBLE ='I' WHERE ID_PRODUIT=".$_GET['id'])){
                echo "Erreur de suppression";
            }else{
                header('Location: consulter.php');
            }
        }
    }else{
        header('Location: ../');
    }
}

