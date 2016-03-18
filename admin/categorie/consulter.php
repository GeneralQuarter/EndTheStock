<?php

include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../');
}

if(!$isUserAdmin){
    header('Location: ../../403.php?page=editerProduit.php');
}

include '../../navbar.php'; 

?>

<div class="container">
    <div class="row">
        <h3>Consultation des catégories</h3><button style="margin-top: -30px;margin-bottom:10px;" role="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#editCategory" data-id=""><span class="glyphicon glyphicon-plus"></span> Ajouter</button>
        <?php if(isset($categories)) { ?>
        <table class="table table-striped">
            <tr>
                <th>Nom</th>
                <th></th>
            </tr>
            <?php foreach($categories as $categorie){ ?>
            <tr>
                <td class="vert-align"><?php echo $categorie->getNom() ?></td>
                <td class="vert-align">
                <?php if($categorie->getId() !== "1"){ ?>
                <a role="button" style="margin-right: 10px;" class="btn btn-default pull-right" data-toggle="modal" data-target="#editCategory" data-nom="<?php echo $categorie->getNom() ?>" data-id="<?php echo $categorie->getId() ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php }else{ ?>
        <p>Aucune catégorie</p>
        <?php } ?>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="Editer Categorie">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Ajouter une catégorie</h3>
            </div>
            <form action="editer.php" method="POST">
            <div class="modal-body">
                <input type="hidden" id="inputId" name="id" value="" />
                <input class="form-control" type="text" maxlength="30" id="inputNom" name="nom" value="" placeholder="Nom de la catégorie" required/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <input type="submit" class="btn btn-success"  id="comfirmButton" value="Confirmer">
            </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>

<script>
   $('#deleteCategory').on('show.bs.modal', function (event){
       var button = $(event.relatedTarget);
       var idCategorie = button.data('id');
       var modal = $(this);
       modal.find('.nomCategorie').text(button.data('nom'));
       modal.find('#comfirmButton').attr('href', 'retirer.php?id=' + idCategorie);
   });
   
   $('#editCategory').on('show.bs.modal', function (event){
       var button = $(event.relatedTarget);
       var idCategorie = button.data('id');
       var modal = $(this);
       if(!idCategorie){
           modal.find('.modal-title').text('Ajouter une catégorie');
           modal.find('#inputId').val('');
           modal.find('#inputNom').val('');
           modal.find('#comfirmButton').val('Ajouter');
       }else{
           modal.find('.modal-title').text('Editer une catégorie');
           modal.find('#inputId').val(idCategorie);
           modal.find('#inputNom').val(button.data('nom'));
           modal.find('#comfirmButton').val('Sauvegarder');
       }
   });
</script>

