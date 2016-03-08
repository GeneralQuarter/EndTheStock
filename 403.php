<?php include 'header.php' ?>
<?php include 'navbar.php' ?>
<?php if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 'cette page';
} ?>
<div class="container">
    <div class="row">
        <h1>Erreur 403</h1>
        <h3>Désolée vous n'avez pas les droits nécessaires pour accéder à <?php echo $page ?></h3>
        <a role="button" class="btn btn-primary" href='<?php echo $documentRoot ?>/'>Retour vers l'accueil</a>
    </div>
</div>
<?php include 'footer.php' ?>


