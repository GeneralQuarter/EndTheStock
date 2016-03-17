<?php

include '../header.php';
include '../navbar.php';

?>
<div class="container">
    <br>
    <h2 class="titreRubrique">Nous envoyer un message</h2>
    <form action="envoi.php" method="POST">
        <div class="form-group">
            <label for="inputDescProduit" >Objet du message</label>
            <input type="text" id="inputDescProduit" name="objet" class="form-control" required/>
        </div>
        <div class="form-group">
            <label for="inputDescProduit" >Contenu du message</label>
            <textarea type="text" rows="12" id="inputDescProduit" name="contenu" class="form-control" required></textarea>
        </div>

        <input type="submit" class="btn btn-success"  id="comfirmButton" value="Envoyer"/>
    </form>
</div>

<?php
include '../footer.php';
?>

