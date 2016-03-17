<?php

include '../header.php';

if($isUserConnected){
    //Display profil
    include '../navbar.php';
    
    if ($isBD) {
        $res = $bd->query('SELECT * FROM ADRESSE WHERE ID_ADRESSE = ' . $user->getAdresse_id());
        $com = $bd->query('SELECT * FROM COMMANDE WHERE ID_CLIENT = ' . $user->getId());
    }

    if($res !== false) while($row = $res->fetch_assoc()){
    $adresse = new Adresse($row['ID_ADRESSE'], $row['NUMERO_CIVIQUE'] , $row['RUE'],
            $row['VILLE'], $row['DEPARTEMENT'], $row['REGION'] , $row['PAYS']);
    $adresseValide = true;
    }else{
        $adresseValide = false;
    }
    
    $commandes = [];
    if($com !== false) while($r = $com->fetch_assoc()){
        $commandes[] = new CommandeEffectuee($r['ID_COMMANDE'],$r['DATE_COMMANDE']);
    }
    ?>
<div class="container">
    <div class="row">
        <h3 class="titreRubrique">Profil de <?php echo $user->getPrenom() . ' ' . $user->getNom() ?></h3>
        <p>Identifiant :  <?php echo $user->getPseudo() ?> </p>
        <p>Numéro de Télephone :  <?php echo $user->getTelephone() ?> </p>
        <p>Courriel :  <?php echo $user->getCourriel() ?> </p><BR>
        <button class="btn btn-default" style="margin-top:-35px;" data-toggle="modal" data-target="#modifForm">Modifier les informations</button>
        <button class="btn btn-default" style="margin-top:-35px;" data-toggle="modal" data-target="#modifMdpForm">Modifier le mot de passe</button>
        <h4 class="titreRubrique">Adresse</h4>
        <?php if($adresseValide){
            echo '<p>'.$adresse->getNumero_civique() . ' ' . $adresse->getRue().'</p>';
            echo '<p>'.$adresse->getDepartement() . ' ' . $adresse->getVille().'</p>';
            echo '<p>'.$adresse->getRegion().'</p>';
            echo '<p>'.$adresse->getPays().'</p>';
            echo '<button style="margin-top: -30px;margin-bottom:10px;" role="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#editAdresse" data-id=""><span class="glyphicon glyphicon-plus"></span> Modifier votre adresse</button>';
        }else{
            echo '<button style="margin-top: -30px;margin-bottom:10px;" role="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#editAdresse" data-id=""><span class="glyphicon glyphicon-plus"></span> Ajouter votre adresse</button>';
        }
        ?>
    </div>
    <br>
    <h2 class="titreRubrique">Historique des commandes</h2>
    <table class="table table-hover">
            <thead>
                <th>Date de la commande</th>
                <th>Prix hors taxe</th>
            </thead>
            <?php
            foreach ($commandes as $commande){
                $prixHT = 0;
                if ($isBD) {
                    $lig = $bd->query('SELECT * FROM LIGNE_COMMANDE WHERE ID_COMMANDE = ' . $commande->getId());
                }
                $lignes= [];
                if($lig !== false) while($r = $lig->fetch_assoc()){
                    $prod = $bd->query('SELECT * FROM PRODUIT WHERE ID_PRODUIT ='.$r['ID_PRODUIT']);
                    if($prod !== false) while($res = $prod->fetch_assoc()){
                        $produit = new Produit($res['ID_PRODUIT'], $res['NOM_PRODUIT'], $res['DESCRIPTION'], 
                                                $res['CATEGORIE'], $res['PRIX'], $res['TAXE'], 
                                                $res['IMAGE'], $res['ALT'],$res['VISIBLE']);
                    }
                    $lignes[] = new LigneCommande($r['QUANTITEE'],  serialize($produit));
                    
                }
                foreach ($lignes as $ligne){
                    $prixHT += $ligne->getPrixHorsTaxe();
                }
            ?>
            <tr>
                <td class="vert-align" style="width: 200px;"><?php echo $commande->getDate(); ?></td>
                <td class="vert-align" style="width: 100px;"><?php echo $prixHT; ?></td>
            </tr>
        <?php } ?>
        </table>
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
} ?>

<!-- REGISTER FORM --->
<div class="modal fade" id="modifForm" tabindex="-1" role="dialog" aria-labelledby="Formulaire d'inscription">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Modification des informations de profil</h3>
            </div>
            <form class="horizontal-form" action="<?php echo $documentRoot ?>/utilisateur/modificationProfil.php" method="POST" onsubmit="return checkForm(this)">
                <div class="modal-body" style="padding-bottom:0px">
                    <h4>Informations générales</h4>
                    <div class="form-group">
                        <input class="form-control" type="text" value="<?php echo $user->getNom() ;?>" name="nom" maxLength="50" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" value="<?php echo $user->getPrenom() ;?>" name="prenom" maxLength="50" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" value="<?php echo $user->getCourriel() ;?>" name="courriel" maxLength="50" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="tel" value="<?php echo $user->getTelephone() ;?>"  name="tel" maxLength="10" />
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <input type="submit" value="Valider" class="btn btn-primary" />
                </div>
                
                <hr>
            </form>
        </div>
    </div>
</div>

<!-- REGISTER FORM --->
<div class="modal fade" id="modifMdpForm" tabindex="-1" role="dialog" aria-labelledby="Formulaire de changement de mot de passe">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Changement de mot de passe</h3>
            </div>
            <form class="horizontal-form" action="<?php echo $documentRoot ?>/utilisateur/enregistrement.php" method="POST" onsubmit="return checkForm(this)">
                <hr>
                <div class="modal-body" style="padding-top:0">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Votre ancien mot de passe" name="ancienmdp" maxLength="50" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="mdp1" type="password" placeholder="Nouveau mot de passe" name="mdp" maxLength="50" minlength="3" required/>
                    </div>
                    <div class="form-group" id="mdp2group">
                        <input data-toggle="popover" data-trigger="focus" data-content="Vos mot de passes ne correspondent pas" placement="bottom" class="form-control" id="mdp2" type="password" placeholder="Retapez mot de passe" name="mdp2" maxLength="50" minlength="3" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <input type="submit" value="Inscription" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>