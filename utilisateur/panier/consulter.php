<?php
include '../../header.php';
include '../../navbar.php';

if (!$isUserConnected) {
    header('Location: ../../');
}

if ($isCommande) {
    $prixTotalTaxe = 0;
    /* @var $commande Commande */
    ?>
    <div class="container">
        <div class="row">
            <h2 class="titreRubrique pull-left">Panier</h2>
            <a class="btn btn-danger pull-right" style="margin-top:50px"href="viderPanier.php" role="button"> <span class="glyphicon glyphicon-trash"></span> Vider le panier </a>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                <th></th>
                <th>Nom du produit</th>
                <th style="text-align: center;">Quantitée</th>
                <th style="text-align:right">Prix hors taxes</th>
                <th style="text-align:right">Prix avec taxes</th>
                <th style="text-align: right">Retirer</th>
                </thead>
                <?php
                foreach ($commande->getLignes() as $ligne) {
                    $ligne = unserialize($ligne);
                    $produit = unserialize($ligne->getProduit());
                    ?>
                    <tr data-id="<?php echo $produit->getId(); ?>" style="cursor: pointer;">
                        <td class="vert-align" style="width: 100px;"><img src="<?php echo $documentRoot . $produit->getUrlImage(); ?>" alt="<?php echo $produit->getAltImage(); ?>" class="imagePanier"></td>
                        <td class="vert-align" style="width: 200px;"><?php echo $produit->getNom(); ?></td>
                        <td class="vert-align" style="text-align: center; width: 100px;"><?php echo $ligne->getQuantitee(); ?></td>
                        <td class="vert-align" style="text-align:right"><?php echo $ligne->getPrixHorsTaxeString(); ?> $ CAD</td>
                        <td class="vert-align" style="text-align:right"><?php echo $ligne->getPrixAvecTaxeString(); ?> $ CAD</td>
                        <td class="vert-align">
                            <form class="form-inline pull-right" action="retirer.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $produit->getId() ?>" />
                                <?php if ($ligne->getQuantitee() === 1) { ?>
                                    <input type="hidden" name="quantitee" value="1" />
                                    <button class="btn btn-danger" name="submit" type="submit"> <span class="glyphicon glyphicon-trash"></span> </button>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <div class="input-group" >
                                            <input class="form-control" type="number" value="1" min="1" max="<?php echo $ligne->getQuantitee() ?>" name="quantitee" />
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger" name="submit" type="submit"> <span class="glyphicon glyphicon-trash"></span> </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?> 
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="row">
            <h3 class="pull-right" >Prix total avec taxes : <?php echo $commande->getPrixAvecTaxeString() ?> $ CAD</h3>
        </div>
        <?php
        if ($isBD) {
            $res = $bd->query('SELECT * FROM ADRESSE WHERE ID_ADRESSE = ' . $user->getAdresse_id());
            if ($res !== false)
                while ($row = $res->fetch_assoc()) {
                    $adresse = new Adresse($row['ID_ADRESSE'], $row['NUMERO_CIVIQUE'], $row['RUE'], $row['VILLE'], $row['DEPARTEMENT'], $row['REGION'], $row['PAYS']);
                    $adresseValide = true;
                } else {
                $adresseValide = false;
            }
        }
        ?>
        
        <?php if ($user->getAdresse_id() !== null && count($commande->getLignes()) > 0) { ?>
        <div class="row">
            <div class="col-md-4 pull-left">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Adresse de livraison</b></div>
                    <div class="panel-body">
                            <?php if ($adresseValide) {
                                echo '<p>' . $adresse->getNumero_civique() . ' ' . $adresse->getRue() . '</p>';
                                echo '<p>' . $adresse->getDepartement() . ' ' . $adresse->getVille() . '</p>';
                                echo '<p>' . $adresse->getRegion() . '</p>';
                                echo '<p>' . $adresse->getPays() . '</p>';
                                echo '<button role="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#editAdresse" data-id=""><span class="glyphicon glyphicon-pencil"></span> Modifier votre adresse</button>';
                            } ?>
                        </div>
                    </div>
                </div>
                <a class="btn btn-success btn-lg pull-right" href="recapitulatifCommande.php" role="button"><span class="glyphicon glyphicon-ok"></span> Passer la commande</a>
            </div>
    <?php } else { ?>
            <div class="row">
                <a class="btn btn-success  btn-lg pull-right" href="#" disabled="disabled" role="button"><span class="glyphicon glyphicon-ok"></span> Passer la commande</a>
            </div>
        <?php if ($user->getAdresse_id() == null) { ?>
                <div class="row" style="margin-top: 30px;">
                    <button role="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#editAdresse" data-id=""><span class="glyphicon glyphicon-plus"></span> Ajouter une adresse</button>
                    <p class="pull-right" style="margin: 10px;">Ajoutez une adresse pour pouvoir commander</p>
                </div>
        <?php } ?>
    <?php } ?>
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
                    <input type="hidden" id="inputId" name="idClient" value="<?php $user->getId() ?>" />
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
                    <input type="submit" class="btn btn-success"  id="comfirmButton" value="Confirmer">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../footer.php'; ?>

<script>

    $("tr").click(function (e) {
        document.location = '../../produit/detail.php?id=' + $(this).data('id');
    });

    $("tr input").click(function (e) {
        e.stopPropagation();
    });

    $("tr button").click(function (e) {
        e.stopPropagation();
    });
</script>