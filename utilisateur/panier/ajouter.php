<?php include '../../header.php'; 

if(!$isUserConnected) {
    header('Location: ../../index.php');
}

if(isset($_POST['quantitee']) && isset($_POST['produit'])){
    $produit = unserialize(base64_decode($_POST['produit']));
    if($isCommande){
        $commande->ajouterLigne($produit, $_POST['quantitee']);
        $_SESSION['commande'] = serialize($commande);
        
    }
}


header('Location: consulter.php');

?>

