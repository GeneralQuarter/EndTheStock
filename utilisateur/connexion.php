<?php

include '../session.php';
include '../bd/BD.php';

if (isset($_POST) && !empty($_POST)) {
    $user = new User(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS), sha1($bd->escape_string($_POST['mdp'])));
    
    if($isBD){
        $res = $bd->query("SELECT * FROM UTILISATEUR WHERE PSEUDO='".$bd->escape_string($user->getPseudo())."' AND MDP='".$user->getMdp()."'");
        if($row = $res->fetch_assoc()){
            $user->setId($row['ID_UTILISATEUR']);
            $user->setAdresse_id($row['ADRESSE']);
            $user->setCourriel($row['COURRIEL']);
            $user->setNom($row['NOM_CLIENT']);
            $user->setPrenom($row['PRENOM_CLIENT']);
            $user->setRole($row['ROLE']);
            $user->setTelephone($row['TELEPHONE']);

            $_SESSION['user'] = serialize($user);
            
            $commande = new Commande();
            $_SESSION['commande']= serialize($commande);
            header('Location: ../');
        }else{
            echo 'Erreur de connexion';
        }
    }
}

