<?php 
    include '../header.php';
    include '../navbar.php';

if ($isCommande) {
    if ($isBD) {
        if (!$bd->query("INSERT INTO COMMANDE(DATE_COMMANDE, ID_CLIENT) VALUES ('" . date("d-m-Y") . "','" . $user->getId() . "'")) {
            echo 'Erreur d\'insertion commande';
        } else {
            echo 'Insertion commande réussie';
        }
    } 

    foreach ($commande->getLignes() as $ligne){ 
            $ligne=  unserialize($ligne);
            $produit = unserialize($ligne->getProduit()); 
            
            if (!$bd->query("INSERT INTO LIGNE_COMMANDE(ID_COMMANDE, ID_PRODUIT, QUANTITEE) VALUES (LAST_INSERT_ID(),'" . $produit->getId() . "'" . $ligne->getQuantitee() . "'")) {
                echo 'Erreur d\'insertion ligne';
            } else {
                echo 'Insertion ligne réussie';
            }
         }
    
?>

<div class="container">
    <div class="row">
        <h2>
            Votre commande a bien été prise en compte ! 
        </h2>
        <a role="button" class="btn btn-primary" href='<?php echo $documentRoot ?>/'>Retour vers l'accueil</a>
    </div>
</div>

    <?php include '../footer.php';
}else{
    header('Location: ../');
}

?>