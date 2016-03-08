<?php

include '../header.php';
include 'adresse/Adresse.php';

if($isUserConnected){
    //Display profil
    include '../navbar.php';
    
    if ($isBD) {
        $res = $bd->query('SELECT * FROM ADRESSE WHERE ID_ADRESSE = ' . $user->getAdresse_id());
    }

    if($res !== false) while($row = $res->fetch_assoc()){
    $adresse = new Adresse($row['ID_ADRESSE'], $row['NUMERO_CIVIQUE'] , $row['RUE'],
            $row['VILLE'], $row['DEPARTEMENT'], $row['REGION'] , $row['PAYS']);
    $adresseValide = true;
    }else{
        $adresseValide = false;
    }
    ?>
<div class="container">
    <div class="row">
        <h3>Profil de <?php echo $user->getPrenom() . ' ' . $user->getNom() ?></h3>
        <p>Identifiant :  <?php echo $user->getPseudo() ?> </p>
        <p>Numéro de Télephone :  <?php echo $user->getTelephone() ?> </p><BR>
        <h4>Adresse</h4>
        <?php if($adresseValide){
            echo '<p>'.$adresse->getNumero_civique() . ' ' . $adresse->getRue().'</p>';
            echo '<p>'.$adresse->getDepartement() . ' ' . $adresse->getVille().'</p>';
            echo '<p>'.$adresse->getRegion().'</p>';
            echo '<p>'.$adresse->getPays().'</p>';
        }else{
            echo '<button style="margin-top: -30px;margin-bottom:10px;" role="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#editAdresse" data-id=""><span class="glyphicon glyphicon-plus"></span> Ajouter une adresse</button>';
        }
        ?>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editAdresse" tabindex="-1" role="dialog" aria-labelledby="Editer Adresse">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Renseigner une adresse</h3>
            </div>
            <form action="adresse/editer.php" method="POST">
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

    <?php include '../footer.php';
}else{
    header('Location: ../');
}