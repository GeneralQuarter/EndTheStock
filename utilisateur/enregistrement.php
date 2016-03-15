<?php

include '../header.php';

if (isset($_POST) && !empty($_POST)) {
    $nom = $bd->escape_string((string) filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS));
    $prenom = $bd->escape_string((string) filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS));
    $pseudo = $bd->escape_string((string) filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS));
    $email = $bd->escape_string((string) filter_input(INPUT_POST, 'courriel', FILTER_SANITIZE_SPECIAL_CHARS));
    $mdp = sha1($bd->escape_string((string) filter_input(INPUT_POST, 'mdp')));
    $mdp2 = sha1($bd->escape_string((string) filter_input(INPUT_POST, 'mdp2')));
    if($mdp !== $mdp2){
        $message = "Erreur d'inscription : Mots de passes différents !";
    }
    if (filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_SPECIAL_CHARS) !== false) {
        $tel = '\''. $bd->escape_string((string) filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_SPECIAL_CHARS)). '\'';
    } else {
        $tel = 'NULL';
    }
    
    if ($isBD) {
        if (!$bd->query("INSERT INTO UTILISATEUR(PSEUDO, MDP, ROLE, NOM_CLIENT, PRENOM_CLIENT, COURRIEL, TELEPHONE) VALUES ('" . $pseudo . "','" . $mdp . "','CLIENT','" . $nom . "','" . $prenom . "','" . $email . "'," . $tel . ")")) {
            $message = "Erreur d'inscription : Une erreur est survenue pendant votre inscription veuillez réessayer plus tard";
        } else {
            $message = 'Inscription réussie';
        }
    }
    
    include '../navbar.php'; ?>

<div class="container">
    <div class="row">
        <h2><?php echo $message ?></h2>
        <a role="button" class="btn btn-primary" href='<?php echo $documentRoot ?>/'>Retour vers l'accueil</a>
    </div>
</div>

    <?php include '../footer.php';
}else{
    header('Location: ../');
}

