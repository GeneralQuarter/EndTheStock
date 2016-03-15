<?php
include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../');
}

if($isCommande){
    $_SESSION['commande'] = serialize(new Commande());
    header('Location: consulter.php');
}else{
    header('Location: ../../');
}

?>
