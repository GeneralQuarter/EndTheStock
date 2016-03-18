<?php include 'header.php' ?>
<?php include 'navbar.php' ?>

<?php 
    $total = 0;
    if ($isBD) {
        $res = $bd->query('SELECT COUNT(*) AS total FROM PRODUIT WHERE VISIBLE = \'V\'');
        if($res !== false) $total = $res->fetch_assoc()['total'];
        
        $nombreDePages=ceil($total/$produitsParPage);
    
        $page = (int) filter_input(INPUT_GET, 'page');
        $page = ($page <= 0)? 1 : $page;
        $page = ($page > $nombreDePages)? $nombreDePages : $page;

        $premiereEntree = ($page-1)*$nombreDePages;
        
        $res = $bd->query('SELECT * FROM PRODUIT WHERE VISIBLE = \'V\' ORDER BY ID_PRODUIT DESC LIMIT '.$premiereEntree.', '.$produitsParPage.'');
    }

    $produits = [];
    if($res !== false) while($row = $res->fetch_assoc()){
        $produits[] = new Produit($row['ID_PRODUIT'], $row['NOM_PRODUIT'], $row['DESCRIPTION'], 
                $row['CATEGORIE'], $row['PRIX'], $row['TAXE'], 
                $row['IMAGE'], $row['ALT'], $row['VISIBLE']);
    }
?>

<div class="jumbotron" style="background-image: url(<?php echo $documentRoot; ?>/img/fond/fond.png)">
    <div class="container" >
        <h1 id="titreSite">END THE STOCK</h1>
        <div id="textPresentation"><?php include('admin/page/index.html'); ?></div>
        <?php if($isUserConnected && $isUserAdmin){ ?>    
        <p><a class="btn btn-primary pull-right" role="button" data-toggle="modal" data-target="#editPresentation">Modifier la présentation</a></p>
        <?php } ?>
    </div>
</div>

<div class="container">
    <?php if($nombreDePages > 1 ){ ?>
    <div class="row">
        <nav class="pull-right">
            <ul class="pagination">
              <li <?php if($page === 1){ ?> class="disabled"<?php } ?>><a href="index.php?page=<?php echo ($page-1 > 0)? ($page-1) : 1; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
              <?php for($i = 0; $i < $nombreDePages; $i++){ ?>
              <li <?php if(($i+1) === $page){ ?>class="active" <?php } ?>><a href="index.php?page=<?php echo ($i+1) ?>"><?php echo ($i+1); ?> </a></li>
              <?php } ?>
              <li<?php if($page == $nombreDePages){ ?> class="disabled" <?php } ?>><a href="index.php?page=<?php echo ($page+1 <= $nombreDePages)? ($page+1) : $nombreDePages; ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            </ul>
        </nav>
    </div><
    <?php } ?>
    <div class="row">
        <?php foreach($produits as $produit){ 
            if($produit->getVisible() !== 'I'){?>
            <div class="col-md-4">
                <img src="<?php echo $documentRoot.$produit->getUrlImage(); ?>" alt="<?php echo $produit->getAltImage(); ?>" style="width:auto;height:280px;">
                <h2 class="titreBloc"><?php echo $produit->getNom(); ?></h2>
                <p><?php echo $produit->getPrix(); ?> $ CAD</p>
                <p><a class="btn btn-default" href="admin/produit/detail.php?id=<?php echo $produit->getId(); ?>" role="button">Détails</a></p>
            </div>
            <?php }} ?>
    </div>
    <?php if($nombreDePages > 1 ){ ?>
    <div class="row">
        <nav class="pull-right">
            <ul class="pagination">
              <li <?php if($page === 1){ ?> class="disabled"<?php } ?>><a href="index.php?page=<?php echo ($page-1 > 0)? ($page-1) : 1; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
              <?php for($i = 0; $i < $nombreDePages; $i++){ ?>
              <li <?php if(($i+1) === $page){ ?>class="active" <?php } ?>><a href="index.php?page=<?php echo ($i+1) ?>"><?php echo ($i+1); ?> </a></li>
              <?php } ?>
              <li<?php if($page == $nombreDePages){ ?> class="disabled" <?php } ?>><a href="index.php?page=<?php echo ($page+1 <= $nombreDePages)? ($page+1) : $nombreDePages; ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            </ul>
        </nav>
    </div>
    <?php } ?>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editPresentation" tabindex="-1" role="dialog" aria-labelledby="Editer Presentation">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Modifier le texte de présentation</h3>
            </div>
            <form action="admin/page/editer.php" method="POST">
            <div class="modal-body">
                <input type="hidden" id="page" name="page" value="index" />
                <textarea name="editeur" id="editeur" rows="10" cols="80">
                    <?php echo file_get_contents('admin/page/index.html') ?>
                </textarea>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-success"  id="comfirmButton" value="Confirmer">
            </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editeur' );
</script>