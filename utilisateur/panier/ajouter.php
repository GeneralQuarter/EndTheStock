<?php include '../../header.php'; 

if(!$isUserConnected) {
    header('Location: ../../index.php');
}

$quantitee = (int) filter_input(INPUT_POST, 'quantitee');
$produitInput = (string) filter_input(INPUT_POST, 'produit');
$produit = unserialize(base64_decode($produitInput));

if($isCommande){
    $commande->ajouterLigne($produit, $quantitee);
    $_SESSION['commande'] = serialize($commande);

}

header('Location: consulter.php');

