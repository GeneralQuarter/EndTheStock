<?php
include '../header.php';
include '../navbar.php'; 

if($isBD){
    if(isset($_POST['ancienmdp']) && !empty($_POST['ancienmdp'])
    && isset($_POST['mdp']) && !empty($_POST['mdp'])
    && isset($_POST['mdp2']) && !empty($_POST['mdp2'])){
        $mdpActuel = [];
        $res = $bd->query("SELECT MDP FROM UTILISATEUR WHERE ID_UTILISATEUR = ".$user->getId());
        if($res !== false) while($row = $res->fetch_assoc()){
            $mdpActuel[0] = $row['MDP'];
        }
        //echo $mdpActuel[0].'<BR>';
        $ancienMdpEntre = sha1($bd->escape_string($_POST['ancienmdp']));
        $mdp1 = sha1($bd->escape_string($_POST['mdp']));
        $mdp2 = sha1($bd->escape_string($_POST['mdp2']));
        //echo $ancienMdpEntre;  
        if($mdp1 == $mdp2){
            if($mdpActuel[0] == $ancienMdpEntre){
                if($bd->query("UPDATE UTILISATEUR SET MDP = '". $mdp1 . "' WHERE ID_UTILISATEUR = " . $user->getId())){
                    ?>
                    <div class="container">
                        <div class="row">
                            <h2 class="titreRubrique">Votre mot de passe a bien été modifié !</h2>
                            <a role="button" class="btn btn-primary pull-right" href='<?php echo $documentRoot ?>/utilisateur/profil.php'>Retour vers le profil</a>
                        </div>
                    </div>
                    
                    <?php
                }else{
                    echo 'Erreur : La modification du mot de passe a échouée <BR>';
                }
            }else{
                echo 'Erreur : Le mot de passe que vous avez entré ne correspond pas à votre ancien mot de passe';
                echo $mdpActuel[0];
                echo $ancienMdpEntre;
            }
        }else{
            echo 'Erreur : Les nouveaux mots de passe ne correspondent pas';
        }
    }else{
        echo 'Erreur : Veuillez remplir tous les champs.';
    }
    
}else{
    echo 'Erreur : Problème de base de données.';
}

?>



    
<?php include '../footer.php'; ?>