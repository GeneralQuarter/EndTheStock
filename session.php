<?php 

session_start();

include 'utilisateur/User.php';
include 'admin/categorie/Categorie.php';
include 'admin/produit/Produit.php';
include 'utilisateur/adresse/Adresse.php';
include 'utilisateur/panier/LigneCommande.php';
include 'utilisateur/panier/Commande.php';
include 'utilisateur/panier/CommandeEffectuee.php';
include 'constantes.php';

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

if(isset($_SESSION['commande'])){
    $isCommande = true;
    $commande = unserialize($_SESSION['commande']);
}else{
    $isCommande = false;
}
