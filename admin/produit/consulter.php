<?php
include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../index.php');
}

if(!$isUserAdmin){
    header('Location: ../../403.php?page=editerProduit.php');
}

include '../../navbar.php'; 

$produits = [];

if($isBD){
    $res = $bd->query("SELECT * FROM PRODUIT");
}

if ($res !== false) {
    while ($row = $res->fetch_assoc()) {
        $produits[] = new Produit($row['ID_PRODUIT'], $row['NOM_PRODUIT'], $row['DESCRIPTION'], $row['CATEGORIE'], $row['PRIX'], $row['TAXE'], $row['IMAGE'], $row['ALT'], $row['VISIBLE']);
    }
}
?>

<div class="container">
    <div class="row">
        <h3>Consultations des produits</h3>
        <table class="table table-hover">
            <thead>
                <th>Produit</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Taxe</th>
                <th></th>
            </thead>
            <?php foreach($produits as $produit) { 
                if($produit->getVisible() !== 'I'){ ?>
            <tr data-id="<?php echo $produit->getId(); ?>" style="cursor: pointer;">
                <td class="vert-align" style="width: 100px"><img src="<?php echo $documentRoot.$produit->getUrlImage(); ?>" alt="<?php echo $produit->getAltImage();?>" class="imagePanier"></td>
                <td class="vert-align"><?php echo $produit->getNom() ?></td>
                <td class="vert-align"><?php echo $categories[$produit->getCategorieID()]->getNom(); ?></td>
                <td class="vert-align"><?php echo $produit->getPrix() ?> $ CAD</td>
                <td class="vert-align"><?php echo $produit->getTaxe() ?> %</td>
                <td class="vert-align"><a id="deleteButton" role="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#deleteProduit" data-nom="<?php echo $produit->getNom() ?>" data-id="<?php echo $produit->getId() ?>"><span class="glyphicon glyphicon-trash"></span></a>
                <a role="button" style="margin-right: 10px;" class="btn btn-default pull-right" href="editer.php?produit=<?php echo base64_encode(serialize($produit)) ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            </tr>
                <?php }} ?>
        </table>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteProduit" tabindex="-1" role="dialog" aria-labelledby="Retirer Produit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Retirer <span class="nomProduit"></span></h3>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment retirer <span class="nomProduit"></span> ? <br>
                    Cette action est irréversible !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <a type="button" class="btn btn-danger"  id="comfirmButton" href="retirer.php">Confirmer</a>
            </div>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>

<script>
   $('#deleteProduit').on('show.bs.modal', function (event){
       var button = $('#deleteButton');
       var idProduit = button.data('id');
       var modal = $(this);
       modal.find('.nomProduit').text(button.data('nom'));
       modal.find('#comfirmButton').attr('href', 'retirer.php?id=' + idProduit);
   });
   
   $("tr").click(function(e){
        document.location = 'detail.php?id=' + $(this).data('id');
    });
   
   $("tr a").click(function(e) {
       e.stopPropagation();
       if($(this).attr('id') === "deleteButton"){
           $('#deleteProduit').modal('show');
       }
   });
</script>


