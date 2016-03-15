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
                <td class="vert-align"><?php echo $ligne->getPrixHorsTaxeString(); ?> $ CAD</td>
                <td class="vert-align"><?php echo $ligne->getPrixAvecTaxeString(); ?> $ CAD</td>
                <td class="vert-align"><a class="btn btn-danger pull-right" href="#" role="button">Supprimer</a></td>
            </tr>
        <?php } ?>
        </table>
        <h3 class="pull-right" >Prix total avec taxe : <?php echo $commande->getPrixAvecTaxeString() ?> $ CAD</h3>
    </div>
    <?php 
    if($user->getAdresse_id()!== null) {?>
        <div class="row"><a class="btn btn-success pull-right" href="enregistrerCommande.php" role="button">Passer la commande</a></div>
    <?php }else{ ?>
        <div class="row">
            <a class="btn btn-success pull-right" href="#" disabled="disabled" role="button">Passer la commande</a>
        </div>
        
        <div class="row" style="margin-top: 30px;">
            <button role="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#editAdresse" data-id=""><span class="glyphicon glyphicon-plus"></span> Ajouter une adresse</button>'
            <p class="pull-right" style="margin: 10px;">Ajoutez une adresse pour pouvoir commander</p>
        </div>
        
    <?php } ?>
    <div class="row"><a class="btn btn-danger pull-left" href="viderPanier.php" role="button">Vider le panier</a></div>
    
</div>
            
<?php } ?>

<!-- EDIT MODAL -->
<div class="modal fade" id="editAdresse" tabindex="-1" role="dialog" aria-labelledby="Editer Adresse">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Renseigner une adresse</h3>
            </div>
            <form action="../adresse/editer.php" method="POST">
            <div class="modal-body">
                <input type="hidden" id="inputId" name="idClient" value="<?php $user->getId()?>" />
                <p>Numéro civique</p>
                <input class="form-control" type="text" maxlength="6" id="inputNumCiv" name="numero_civique" value="" placeholder="ex : 17" required/><BR>
                <p>Rue</p>
                <input class="form-control" type="text" maxlength="100" id="inputRue" name="rue" value="" placeholder="ex : Avenue Charles de Gaulle" required/><BR>
                <p>Département</p>
                <input class="form-control" type="text" maxlength="100" id="inputDepartement" name="departement" value="" placeholder="ex : 17000" required/><BR>
                <p>Ville</p>
                <input class="form-control" type="text" maxlength="100" id="inputVille" name="ville" value="" placeholder="ex : La Rochelle" required/><BR>
                <p>Region</p>
                <input class="form-control" type="text" maxlength="100" id="inputRegion" name="region" value="" placeholder="ex : Poitou-Charante" required/><BR>
                <p>Pays</p>
                <input class="form-control" type="text" maxlength="100" id="inputPays" name="pays" value="" placeholder="ex : France" required/><BR>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-success"  id="comfirmButton" value="Comfirmer">
            </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>