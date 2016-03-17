<?php 
$categories = [];
if($isBD){
    $res = $bd->query("SELECT * FROM CATEGORIE");
    
    if($res !== false) while($row = $res->fetch_assoc()){
        $categories[$row['ID_CATEGORIE']] = new Categorie($row['ID_CATEGORIE'], $row['NOM_CATEGORIE']);
    }
} ?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="titreNav" href="<?php echo $documentRoot ?>/">END THE STOCK</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php if($isUserConnected && $isUserAdmin){ ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria_haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Administration <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $documentRoot ?>/admin/categorie/consulter.php">Gestion catégories</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo $documentRoot ?>/admin/produit/editer.php">Ajouter un produit</a>
                        <li><a href="<?php echo $documentRoot ?>/admin/produit/consulter.php">Gestion produits</a>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo $documentRoot ?>/utilisateur/consulter.php">Gestion utilisateurs</a>
                    </ul>
                </li>
                <?php } ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria_haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>&nbsp;&nbsp;Catégories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach($categories as $categorie){ ?>
                        <li><a href="<?php echo $documentRoot; ?>/admin/produit/rechercheCategorie.php?categorie=<?php echo $categorie->getId() ?>"><?php echo $categorie->getNom() ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" action="<?php echo $documentRoot ?>/admin/produit/recherche.php" method="GET">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" placeholder="Nom du produit" class="form-control" name="requete">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </div>
            </form>
            <?php if (!$isUserConnected) { ?>
            <ul class="nav navbar-nav navbar-right">
                <?php $erreur = (string) filter_input(INPUT_GET, 'erreurConnexion'); $erreur = ($erreur === 'true')? true : false; ?>
                <li class="dropdown <?php echo ($erreur)? 'open' : ''; ?>">
                    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria_haspopup="true" aria-expanded="<?php echo ($erreur)? 'true' : 'false'; ?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php if(filter_input(INPUT_COOKIE, 'prenom')){ ?>Connecte toi <?php echo filter_input(INPUT_COOKIE, 'prenom');?> ! <?php }else{ ?> Connexion <?php } ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" style="min-width: 300px; padding: 10px;">
                        <?php if($erreur){ ?>
                            <div class="alert alert-danger" role="alert">Erreur de connexion</div>
                        <?php } ?>
                        <form action="<?php echo $documentRoot ?>/utilisateur/connexion.php" method="POST">
                            <div class="form-group">
                                <input type="text" placeholder="Pseudo" name="pseudo" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Mot de passe" name="mdp" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Connexion</button>
                        </form>
                        <button class="btn btn-default pull-right" style="margin-top:-35px;" data-toggle="modal" data-target="#registerForm">S'inscrire</button>
                    </ul>
                </li>
            </ul>               
            <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo $documentRoot ?>/utilisateur/panier/consulter.php"><span class="glyphicon glyphicon-shopping-cart"></span> Panier <span class="badge"><?php echo $commande->getNombreArticles() ?></span></a></li>
                    <li><a href="<?php echo $documentRoot ?>/utilisateur/profil.php"><span class="glyphicon glyphicon-user"></span> <?php echo $user->getPseudo() ?></a></li>
                    <li><a href="<?php echo $documentRoot ?>/utilisateur/deconnexion.php"><span class="glyphicon glyphicon-off"></span></a></li>
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
            <form class="horizontal-form" action="<?php echo $documentRoot ?>/utilisateur/enregistrement.php" method="POST" onsubmit="return checkForm(this)">
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
                        <input class="form-control" id="mdp1" type="password" placeholder="Mot de passe" name="mdp" maxLength="50" minlength="3" required/>
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




