<?php

include '../header.php';

if($isUserConnected){
    //Display profil
    include '../navbar.php';
    ?>
<div class="container">
    <div class="row">
        <h3>Profil de <?php echo $user->getPrenom() . ' ' . $user->getNom() ?></h3>
    </div>
</div>
    <?php include '../footer.php';
}else{
    header('Location: ../');
}

