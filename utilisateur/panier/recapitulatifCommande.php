<?php

include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../');
}

if($isCommande){ ?>

<?php include '../../navbar.php'; ?>

<div class="container">
    <div class="row">
        <h2 class="titreRubrique">Récapitulatif de votre commande</h2>
        <table class="table">
            <thead>
            <th>Produit</th>
            <th style="text-align:right">Prix Hors Taxes</th>
            <th style="text-align:right">Prix Avec Taxes</th>
            </thead>
            <?php foreach($commande->getLignes() as $ligne){ 
            $ligne = unserialize($ligne);
            $produit = unserialize($ligne->getProduit()); ?>
            <tr>
                <td><?php echo $ligne->getQuantitee() ?> x <b><?php echo $produit->getNom() ?></b></td>
                <td style="text-align:right"><?php echo $ligne->getPrixHorsTaxeString() ?> $ CAD</td>
                <td style="text-align:right;font-size:18px;"><?php echo $ligne->getPrixAvecTaxeString() ?> $ CAD</td>
            </tr>
            <?php } ?>
            <tr>
                <th></th>
                <th style="text-align:right">Total Prix Hors Taxes</th>
                <th style="text-align:right">Total Prix Avec Taxes</th>
            </tr>
            <tr>
                <td></td>
                <td style="text-align:right"><?php echo $commande->getPrixHorsTaxeString() ?> $ CAD</td>
                <td style="text-align:right;font-size:24px;"><?php echo $commande->getPrixAvecTaxeString() ?> $ CAD</td>
            </tr>
        </table>
    </div>
    <div class="row">
        <a href="consulter.php" class="btn btn-primary"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modifier</a>
        <a href="enregistrerCommande.php" class="btn btn-success btn-lg pull-right"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> Payer</a>
    </div>
</div>

<?php include '../../footer.php'; ?>

<?php }else{
    //Erreur aucune commande
}

