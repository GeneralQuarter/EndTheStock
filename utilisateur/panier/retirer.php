<?php

include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../');
}

$idProduit = (int) filter_input(INPUT_POST, 'id');
$quantitee = (int) filter_input(INPUT_POST, 'quantitee');
if($idProduit > 0 && $quantitee > 0 && $isCommande){
    echo $idProduit . '<br>';
    echo $quantitee;
    $commande->retirerLigne($idProduit, $quantitee);
    $_SESSION['commande'] = serialize($commande);
}

header('Location: consulter.php');

