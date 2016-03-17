<?php

include '../header.php';
include '../navbar.php';
?>

<div class="container">
<?php 
    if(!isset($_POST['objet']) || !isset($_POST['contenu'])){
        echo '<h2 class="titreRubrique">Veuillez renseigner un objet et un contenu à votre message.</h2>';
    }else{
        if(mail('bsvalentin.pivet@outlook.fr', $_POST['objet'], $_POST['contenu'])){
            echo '<h2 class="titreRubrique">Votre message a bien été envoyé !</h2>';
        }else{
            echo '<h2 class="titreRubrique">Oups ! Le message a pas été envoyé ! :(</h2>';
        }
    }

?>
</div>

<?php
include '../footer.php';
?>