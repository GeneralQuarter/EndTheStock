<?php
include '../header.php';

if (!$isUserConnected) {
    header('Location: ../index.php');
}

if (!$isUserAdmin) {
    header('Location: ../403.php?page=editerProduit.php');
}

include '../navbar.php';

if ($isBD) {
    $res = $bd->query('SELECT * FROM UTILISATEUR');
}
?>

<div class="container">
    <div class="row">
        <h3>Consultation des utilisateurs</h3>
        <!-- Affichage des utilisateurs -->
        <table class="table table-striped">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Role</th>
                <th>Courriel</th>
                <th>Téléphone</th>
                <th>Commandes passées</th>
                <th></th>
            </tr>
            <?php if($res !== false) while ($row = $res->fetch_assoc()) { 
                if ($isBD) {
                    $nbrBd = $bd->query('SELECT COUNT(ID_COMMANDE) AS nbr FROM COMMANDE WHERE ID_CLIENT='.$row['ID_UTILISATEUR']);
                    $nbrCommande = $nbrBd->fetch_assoc();
                }
                ?>
                <tr style="height: 50px">
                    <td class="vert-align"><?php echo $row['NOM_CLIENT']; ?></td>
                    <td class="vert-align"><?php echo $row['PRENOM_CLIENT']; ?></td>
                    <td class="vert-align"><?php echo $row['ROLE']; ?></td>
                    <td class="vert-align"><?php echo $row['COURRIEL']; ?></td>
                    <td class="vert-align"><?php echo $row['TELEPHONE']; ?></td>
                    <td class="vert-align"><?php echo $nbrCommande['nbr'];?></td>
    <?php if ($row['ID_UTILISATEUR'] !== $user->getId()) { ?>
                        <td class="vert-align"><a role="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#deleteUser" data-nom="<?php echo $row['PRENOM_CLIENT']. ' '.$row['NOM_CLIENT'] ?>" data-id="<?php echo $row['ID_UTILISATEUR']?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                    <?php }else{ ?>
                        <td></td>
                    <?php }?>
                </tr>
                <?php }
                ?>
        </table>
    </div>
</div>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="Retirer Utilisateur">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Retirer <span class="nomClient"></span></h3>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment retirer <span class="nomClient"></span> ? <br>
                    Ce client ne pourra plus se connecter !</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <a type="button" class="btn btn-danger"  id="comfirmButton" href="retirer.php">Comfirmer</a>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>

<script>
   $('#deleteUser').on('show.bs.modal', function (event){
       var button = $(event.relatedTarget);
       var idClient = button.data('id');
       var modal = $(this);
       modal.find('.nomClient').text(button.data('nom'));
       modal.find('#comfirmButton').attr('href', 'retirer.php?id=' + idClient);
   });
</script>

