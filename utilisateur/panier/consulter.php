<?php

include '../../header.php';
include '../../navbar.php';

if(!$isUserConnected) {
    header('Location: ../../');
}

if($isCommande){
    $prixTotalTaxe = 0;
    /* @var $commande Commande*/ 
    ?>
<div class="container">
    <div class="row">
        <h2>Panier</h2>
        <table class="table table-hover">
            <tr>
                <th></th>
                <th>Nom du produit</th>
                <th style="text-align: center;">Quantitée</th>
                <th>Prix hors taxe</th>
                <th>Prix avec taxe</th>
                <th></th>
            </tr>
            <?php
            foreach ($commande->getLignes() as $ligne){ 
            $ligne=  unserialize($ligne);
            $produit = unserialize($ligne->getProduit()); 
            ?>
            <tr onclick="document.location = '../../admin/produit/detail.php?id=<?php echo $produit->getId(); ?>';" style="cursor: pointer;">
                <td class="vert-align" style="width: 100px;"><img src="<?php echo $documentRoot.$produit->getUrlImage(); ?>" alt="<?php echo $produit->getAltImage();?>" class="imagePanier"></td>
                <td class="vert-align" style="width: 200px;"><?php echo $produit->getNom(); ?></td>
                <td class="vert-align" style="text-align: center; width: 100px;"><?php echo $ligne->getQuantitee(); ?></td>
                <td class="vert-align"><?php echo $ligne->getQuantitee()*$produit->getPrix(); ?> $ CAD</td>
                <td class="vert-align"><?php echo number_format($ligne->getQuantitee()*$produit->getPrix()*((100+$produit->getTaxe())/100),2); ?> $ CAD</td>
                <td class="vert-align"><a class="btn btn-danger pull-right" href="#" role="button">Supprimer</a></td>
            </tr>
            <?php $prixTotalTaxe += $ligne->getQuantitee()*$produit->getPrix()*((100+$produit->getTaxe())/100); ?>
        <?php } ?>
        </table>
        <h3 class="pull-right" >Prix total avec taxe : <?php echo number_format($prixTotalTaxe,2); ?> $ CAD</h3>
    </div>
    <div class="row"><a class="btn btn-success pull-right" href="enregistrerCommande.php" role="button">Passer la commande ...</a></div>
    
</div>
            
<?php } ?>

<?php include '../../footer.php'; ?>