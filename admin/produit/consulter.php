<?php
include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../index.php');
}

if(!$isUserAdmin){
    header('Location: ../../accesRestraint.php?page=editerProduit.php');
}

include '../../navbar.php'; ?>

<div class="container">
    <div class="row">
        <h3>Consultations des produits</h3>
        <!-- Affichage produits avec controles -->
    </div>
</div>

<?php include '../../footer.php'; ?>


