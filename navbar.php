<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">EndTheStock</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php if (!$isUserConnected) { ?>
                <button class="btn btn-default pull-right" style="margin-top:8px;margin-left:5px" data-toggle="modal" data-target="#registerForm">S'inscrire</button>
                <form class="navbar-form navbar-right" action="<?php echo $documentRoot ?>/utilisateur/connexion.php" method="POST">
                    <div class="form-group">
                        <input type="text" placeholder="Pseudo" name="pseudo" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Mot de passe" name="mdp" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Connexion</button>
                </form>
            <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria_haspopup="true" aria-expanded="false"><?php echo $user->getPseudo(); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="./utilisateur/profil.php">Profil</a></li>
                            <?php if($isUserAdmin) { ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $documentRoot ?>/admin/categorie/consulter.php">Consulter catégories</a>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $documentRoot ?>/admin/produit/editer.php">Ajouter un produit</a>
                            <li><a href="<?php echo $documentRoot ?>/admin/produit/consulter.php">Consulter produits</a>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $documentRoot ?>/utilisateur/consulter.php">Consulter utilisateurs</a>
                            <?php } ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $documentRoot ?>/utilisateur/deconnexion.php">Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>

<!-- REGISTER FORM --->
<div class="modal fade" id="registerForm" tabindex="-1" role="dialog" aria-labelledby="Formulaire d'inscription">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Inscription</h3>
            </div>
            <form class="horizontal-form" action="<?php echo $documentRoot ?>/utilisateur/enregistrement.php" method="POST">
                <div class="modal-body" style="padding-bottom:0px">
                    <h4>Informations générales</h4>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Nom" name="nom" maxLength="50" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Prénom" name="prenom" maxLength="50" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Courriel" name="courriel" maxLength="50" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="tel" placeholder="Téléphone (facultatif)"  name="tel" maxLength="10" />
                    </div>
                </div>
                <hr>
                <div class="modal-body" style="padding-top:0">
                    <h4>Informations de connexion</h4>
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Pseudo" name="pseudo" maxLength="50" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Mot de passe" name="mdp" maxLength="50" required/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Retapez mot de passe" name="mdp2" maxLength="50" required/>
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




