<?php 

session_start();

include 'utilisateur/User.php';
include 'admin/categorie/Categorie.php';
include 'admin/produit/Produit.php';
include 'utilisateur/panier/LigneCommande.php';

if(isset($_SESSION['user'])){
    $isUserConnected = true;
    $user = unserialize($_SESSION['user']);
    if($user->getRole() == 'ADMINISTRATEUR'){
        $isUserAdmin = true;
    }else{
        $isUserAdmin = false;
    }
}else{
    $isUserConnected = false;
}

