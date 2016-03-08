<?php

include '../header.php';

if (isset($_POST) && !empty($_POST)) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['courriel'];
    $mdp = sha1($_POST['mdp']);
    if (isset($_POST['tel']) && !empty($_POST['tel'])) {
        $tel = '\''. $_POST['tel']. '\'';
    } else {
        $tel = 'NULL';
    }
    
    include '../navbar.php'; ?>

<div class="container">
    <div class="row">
        <h2>
        <?php if ($isBD) {
            if (!$bd->query("INSERT INTO UTILISATEUR(PSEUDO, MDP, ROLE, NOM_CLIENT, PRENOM_CLIENT, COURRIEL, TELEPHONE) VALUES ('" . $pseudo . "','" . $mdp . "','CLIENT','" . $nom . "','" . $prenom . "','" . $email . "'," . $tel . ")")) {
                echo 'Erreur d\'insertion';
            } else {
                echo 'Insertion réussie';
            }
        } ?>
        </h2>
        <a role="button" class="btn btn-primary" href='<?php echo $documentRoot ?>/'>Retour vers l'accueil</a>
    </div>
</div>

    <?php include '../footer.php';
}else{
    header('Location: ../');
}

