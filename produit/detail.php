<?php include '../header.php' ?>


<?php 
    if ($isBD) {
        if(filter_input(INPUT_GET, 'id') !== false){
            $id = (int) filter_input(INPUT_GET, 'id');
            if($id > 0){
                $res = $bd->query('SELECT * FROM PRODUIT WHERE ID_PRODUIT='.$id);
            }else{
               header('Location: ../');
            }
        }
    }

    if($res !== false) while($row = $res->fetch_assoc()){
        $produit = new Produit($row['ID_PRODUIT'], $row['NOM_PRODUIT'], $row['DESCRIPTION'], 
                $row['CATEGORIE'], $row['PRIX'], $row['TAXE'], 
                $row['IMAGE'], $row['ALT'] , $row['VISIBLE']);
    }
?>    

<?php include '../navbar.php' ?>

    <div class="container" style="padding-top: 2%;" >
    <div class="row">
        
        <div class="col-md-6" ><img src="<?php echo $documentRoot.$produit->getUrlImage(); ?>" alt="<?php echo $produit->getAltImage();?>" class="imageDetail"></div>
            <div class="col-md-6">
                <div class="row">
                    <h1 class="pull-left titreRubrique"><?php echo $produit->getNom(); ?></h1>
                    <h3 class="pull-right" ><?php echo $produit->getPrix(); ?> $ CAD</h3>
                </div>
                <div class="row">
                    <p><?php echo $produit->getDesc(); ?></p><br>
                </div>
                <div class="row">
                    <h4 class="pull-left">Taxes : <?php echo $produit->getTaxe(); ?> %</h4>
                    <?php if($isUserConnected) { ?>
                    <form  action="../utilisateur/panier/ajouter.php" method="POST">
                        <button type="submit" class="btn btn-primary pull-right" role="button" value=""><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"/></button>
                        <div class="input-group pull-right" style="width: 150px;"><span class="input-group-addon">Quantitée</span> <input class="form-control" type="number" value="1" min="1" style="width : 60px;" max="99" name="quantitee"/></div>
                        <input type="hidden" value="<?php echo base64_encode(serialize($produit)); ?>" name="produit"/>
                    </form>
                    <?php }else{ ?>
                    <p class="pull-right">Connectez vous pour commander cet article</p>
                    <?php } ?>
                </div>
                <?php if($isUserConnected && $isUserAdmin) { ?>
                <div class="row">
                    <a href="editer.php?produit=<?php echo base64_encode(serialize($produit)); ?>" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Modifier</a>
                </div>
                <?php } ?>
            </div>
        
    </div>
</div>


<?php include '../footer.php' ?>
