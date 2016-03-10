<?php include '../../header.php'; 

if(isset($_POST['quantitee']) && isset($_POST['produit'])){
    $ligneCommande = new LigneCommande($_POST['quantitee'],$_POST['produit']);
    $_SESSION['panier']+=$ligneCommande;
    echo $_POST['quantitee'];
}


//header('Location: panier.php');

?>

