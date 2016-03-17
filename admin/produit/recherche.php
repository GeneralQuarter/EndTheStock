<?php include '../../header.php' ?>
<?php include '../../navbar.php' ?>

<?php 
    $r = false;
    if ($isBD) {
        $res = $bd->query('SELECT * FROM PRODUIT WHERE NOM_PRODUIT LIKE \'%'.$bd->escape_string(filter_input(INPUT_GET, 'requete')).'%\''.' AND VISIBLE = \'V\'');
    }

    $produits = [];
    if($res !== false) while($row = $res->fetch_assoc()){
        $produits[] = new Produit($row['ID_PRODUIT'], $row['NOM_PRODUIT'], $row['DESCRIPTION'], 
                $row['CATEGORIE'], $row['PRIX'], $row['TAXE'], 
                $row['IMAGE'], $row['ALT'], $row['VISIBLE']);
        $r = true;
    }
?>
<BR>
<div class="container">
    <div class="row">
        <?php if($r){ ?>
            <h2 class="titreRubrique">Résultats </h2>
            <BR>
            <?php foreach($produits as $produit){ 
                if($produit->getVisible() !== 'I'){?>
                <div class="col-md-4">
                    <img src="<?php echo $documentRoot.$produit->getUrlImage(); ?>" alt="<?php echo $produit->getAltImage(); ?>" style="width:auto;height:280px;">
                    <h2 class="titreBloc"><?php echo $produit->getNom(); ?></h2>
                    <p><?php echo $produit->getPrix(); ?> $ CAD</p>
                    <p><a class="btn btn-default" href="detail.php?id=<?php echo $produit->getId(); ?>" role="button">Détails</a></p>
                </div>
                <?php }} ?>
        <?php }else{ ?>
        <h2 class="titreRubrique">Désolé <?php echo ($isUserConnected)? $user->getPrenom() : 'Billy'; ?>, aucun produit ne correspond à ta recherche !</h2>
        <?php } ?>
    </div>
</div>

<?php include '../../footer.php' ?>
