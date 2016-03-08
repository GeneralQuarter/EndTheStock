<?php
    include '../../header.php';
    include 'Adresse.php';

    if(!$isUserConnected) {
        header('Location: ../../index.php');
    }

    $adresse = new Adresse(0, $_REQUEST['numero_civique'], $_REQUEST['rue'], $_REQUEST['ville'], 
            $_REQUEST['departement'], $_REQUEST['region'], $_REQUEST['pays']);
    echo '<p>'.$adresse->getNumero_civique() . ' ' . $adresse->getRue().'</p>';
            echo '<p>'.$adresse->getDepartement() . ' ' . $adresse->getVille().'</p>';
            echo '<p>'.$adresse->getRegion().'</p>';
            echo '<p>'.$adresse->getPays().'</p>';
            
    if ($isBD) {
        if($res = $bd->query('INSERT INTO ADRESSE (NUMERO_CIVIQUE, RUE, VILLE, DEPARTEMENT, REGION, PAYS)'
                . 'VALUES (\'' . $adresse->getNumero_civique() . '\',\'' . $adresse->getRue() . '\',\'' 
                . $adresse->getVille() . '\',\''. $adresse->getDepartement() . '\',\''
                . $adresse->getRegion(). '\',\'' . $adresse->getPays() . '\')')){
            if($bd->query("UPDATE UTILISATEUR SET ADRESSE=LAST_INSERT_ID() WHERE ID_UTILISATEUR = " . $user->getId())){
                $res = $bd->query("SELECT ADRESSE FROM UTILISATEUR WHERE ID_UTILISATEUR =" . $user->getId());
                $row = $res->fetch_assoc();
                $user->setAdresse_id($row['ADRESSE']);
                echo $user->getAdresse_id();
                $_SESSION['user'] = serialize($user);
                header('Location: ../profil.php');
            }
        }
    }
?>
