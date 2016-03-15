<?php 
    include '../../header.php';
    include '../../navbar.php';

if ($isCommande) {
    if ($isBD) {
        $query = "INSERT INTO COMMANDE(DATE_COMMANDE, ID_CLIENT) VALUES ('" . date_format(new DateTime(), "Y-m-d") . "'," . $user->getId() . ")";
        if (!$bd->query($query)) {
            echo 'Erreur d\'insertion commande : '. $query . '<br>';
        } else {
            //echo 'Insertion commande réussie';
        }
    } 

    foreach ($commande->getLignes() as $ligne){ 
            $ligne = unserialize($ligne);
            $produit = unserialize($ligne->getProduit()); 
            
            $query = "INSERT INTO LIGNE_COMMANDE(ID_COMMANDE, ID_PRODUIT, QUANTITEE) VALUES (LAST_INSERT_ID()," . $produit->getId() . ", " . $ligne->getQuantitee() . ")";
            if (!$bd->query($query)) {
                echo 'Erreur d\'insertion ligne : ' . $query . '<br>';
            } else {
                //echo 'Insertion ligne réussie';
            }
         }
         
         $_SESSION['commande'] = serialize(new Commande());
?>

<div class="container">
    <div class="row">
        <h2>
            Votre commande a bien été prise en compte ! 
        </h2>
        <a role="button" class="btn btn-primary" href='<?php echo $documentRoot ?>/'>Retour vers l'accueil</a>
    </div>
</div>
    
    <?php include '../../footer.php';
}else{
    //Erreur... Affichage ??
    //header('Location: ../../');
}

?>