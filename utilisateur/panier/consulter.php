<?php

include '../../header.php';
include '../../navbar.php';

if(!$isUserConnected) {
    header('Location: ../../');
}

if($isCommande){
    /* @var $commande Commande*/ 
    foreach ($commande->getLignes() as $ligne){ 
            $ligne=  unserialize($ligne);
            $produit = unserialize($ligne->getProduit()); 
            ?>
            <div class="col-md-4">
                <h2><?php echo $produit->getNom(); ?></h2>
                <p><?php echo $ligne->getQuantitee(); ?></p>
                <p><a class="btn btn-default" href="#" role="button">Supprimer</a></p>
            </div>
        <?php  }
}

?>

<?php include '../../footer.php'; ?>