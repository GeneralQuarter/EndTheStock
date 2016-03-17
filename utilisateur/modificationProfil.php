<?php

include '../header.php';

if (isset($_POST) && !empty($_POST)) {
    
    $nom = $bd->escape_string((string) filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS));
    $prenom = $bd->escape_string((string) filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS));
    $email = $bd->escape_string((string) filter_input(INPUT_POST, 'courriel', FILTER_SANITIZE_SPECIAL_CHARS));

    if (filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_SPECIAL_CHARS) !== false) {
        $telSansQuote = $bd->escape_string((string) filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_SPECIAL_CHARS));
        $tel = '\''. $telSansQuote . '\'';
        
    } else {
        $tel = 'NULL';
    }
    
    echo $tel;
    echo $nom;
    echo $prenom;
    echo $email;
    
    if ($isBD) {
        if (!$bd->query("UPDATE UTILISATEUR SET NOM_CLIENT = '". $nom . "' WHERE ID_UTILISATEUR = ". $user->getId())
                || !$bd->query("UPDATE UTILISATEUR SET PRENOM_CLIENT = '". $prenom . "' WHERE ID_UTILISATEUR = ". $user->getId())
                || !$bd->query("UPDATE UTILISATEUR SET COURRIEL = '". $email . "' WHERE ID_UTILISATEUR = ". $user->getId())
                || !$bd->query("UPDATE UTILISATEUR SET TELEPHONE = ". $tel . " WHERE ID_UTILISATEUR = ". $user->getId())) {
            echo "Erreur d'enregistrement : Une erreur est survenue pendant votre enregistrement veuillez réessayer plus tard";
        } else {
            echo 'test';
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setCourriel($email);
            $user->setTelephone($telSansQuote);
            $_SESSION['user'] = serialize($user);
            header('Location: profil.php');
            $expire = 365*24*3600;
            setcookie('prenom',$user->getPrenom(),time()+$expire, $documentRoot.'/');
        }
    }
    
    include '../navbar.php'; ?>


    <?php include '../footer.php';
}else{
    header('Location: ../');
}