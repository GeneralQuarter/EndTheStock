<?php

include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../index.php');
}

if(!$isUserAdmin){
    header('Location: ../../403.php?page=editerProduit.php');
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    if($isBD){
        if(!$bd->query("DELETE FROM PRODUIT WHERE ID_PRODUIT=".$_GET['id'])){
            echo "Erreur de suppression";
        }else{
            header('Location: consulter.php');
        }
    }
}

