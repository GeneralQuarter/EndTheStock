<?php
include '../../header.php';

if (!$isUserConnected) {
    header('Location: ../../index.php');
}

if (!$isUserAdmin) {
    header('Location: ../../403.php?page=editerProduit.php');
}

if($isBD){
    $res = $bd->query("SELECT * FROM CATEGORIE");
}

if($res !== false){ while($row = $res->fetch_assoc()){
    $categories[] = new Categorie($row['ID_CATEGORIE'], $row['NOM_CATEGORIE']);
}}

function codeToMessage($code) 
    { 
        switch ($code) { 
            case UPLOAD_ERR_INI_SIZE: 
                $message = "Votre fichier est trop gros pour le serveur"; 
                break; 
            case UPLOAD_ERR_FORM_SIZE: 
                $message = "Votre fichier est trop gros (>5Mo)";
                break; 
            case UPLOAD_ERR_PARTIAL: 
                $message = "Votre fichier a été partiellement uploadé"; 
                break; 
            case UPLOAD_ERR_NO_FILE: 
                $message = "";
                break; 
            case UPLOAD_ERR_NO_TMP_DIR: 
                $message = "Dossier temporaire manquant"; 
                break; 
            case UPLOAD_ERR_CANT_WRITE: 
                $message = "Impossible d'écrire sur le disque"; 
                break; 
            case UPLOAD_ERR_EXTENSION: 
                $message = "L'extension du fichier est invalide"; 
                break; 

            default: 
                $message = "Erreur d'upload inconnue"; 
                break; 
        } 
        return $message; 
    } 

function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
   //Test1: fichier correctement uploadé
     if ($_FILES[$index]['error'] > 0) return codeToMessage($_FILES[$index]['error']);
   //Test2: taille limite
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return "L'image est trop volumineuse";
   //Test3: extension
     $ext = strtolower(substr(strrchr($_FILES[$index]['name'],'.'),1));
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return "Le fichier uploadé n'est pas une image";
   //Déplacement
     if(!move_uploaded_file($_FILES[$index]['tmp_name'],$destination)) return "L'image n'a pas pu être déplacé sur le serveur";
     
     return "";
}
$edition = false;

if(isset($_GET['produit']) && !empty($_GET['produit'])){
    $produit = unserialize(base64_decode($_GET['produit']));
    $edition = true;
}else{
    $produit = new Produit("", "", "", "", "", "", "", "");
}

if(isset($_POST) && !empty($_POST)){
    $id = null;
    
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $id = $_POST['id'];
    }
    
    if(isset($_FILES['image']) && !empty($_FILES['image'])){
        $image = $_FILES['image'];
        $nom = "produit" . md5(uniqid(rand(), true));
        $erreurUpload = upload('image', "../../img/produit/".$nom, 5242880, ['png','gif','bmp','jpg','jpeg']);
        if($id === null){
            $url = "'/img/produit/".$nom."'";
        }else if($id !== null ){
            $url = "'" . $_POST['url'] . "'";
        }else{
            $url = "NULL";
        }
    }
    
    if($isBD){
        $nomProduit = $bd->escape_string($_POST['nom']);
        $descProduit = $bd->escape_string($_POST['desc']);
        $categorieID = $_POST['categorie'];
        $prix = $_POST['prix'];
        $taxe = $_POST['taxe'];
        if(isset($_POST['alt'])){
            $legendeImage = "'".$bd->escape_string($_POST['alt'])."'";
        }else{
            $legendeImage = 'NULL';
        }
        
        $produit = new Produit($id, $nomProduit, $descProduit, $categorieID, $prix, $taxe, $url, $legendeImage);
        
        if(!$erreurUpload){
            if($id === null){
                $query = "INSERT INTO PRODUIT(NOM_PRODUIT,"
                        . " DESCRIPTION,"
                        . " CATEGORIE,"
                        . " PRIX,"
                        . " TAXE,"
                        . " IMAGE,"
                        . " ALT)"
                        . " VALUES ('".$produit->getNom()."',"
                        . " '".$produit->getDesc()."',"
                        . " ".$produit->getCategorieID().","
                        . " ".$produit->getPrix().","
                        . " ".$produit->getTaxe().","
                        . " ".$produit->getUrlImage().","
                        . " ".$produit->getAltImage().")";
            }else{
                $query = "UPDATE PRODUIT SET NOM_PRODUIT='".$produit->getNom()."', "
                        . "DESCRIPTION='".$produit->getDesc()."', "
                        . "CATEGORIE=".$produit->getCategorieID().", "
                        . "PRIX=".$produit->getPrix().", "
                        . "TAXE=".$produit->getTaxe().", "
                        . "IMAGE=".$produit->getUrlImage().", "
                        . "ALT=".$produit->getAltImage()." "
                        . "WHERE ID_PRODUIT = ".$id;
            }
            if(!$bd->query($query)){
                $erreurInsert = "Erreur d'insertion : " . $query . " : ". $bd->error;
            }else{
                header('Location: ../../');
            }
        }
    }
}

?>

<?php include '../../navbar.php'; ?>

<div class="container">
    <div class="row">
        <h3><?php echo ($edition)? 'Edition' : 'Ajout'; ?> d'un produit</h3>
        <?php 
            if(!empty($erreurUpload)){ ?>
                <div class="alert alert-danger" role="alert">Erreur d'upload : <?php echo $erreurUpload ?></div>
            <?php }
        ?>
        <?php 
            if(!empty($erreurInsert)){ ?>
                <div class="alert alert-danger" role="alert"><?php echo $erreurInsert ?></div>
            <?php }
        ?>
        <form class="horizontal-form" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $produit->getId() ?>" />
            <input type="hidden" name="url" value="<?php echo $produit->getUrlImage() ?>" />
            <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
            <div class="form-group">
                <label for="inputNomProduit" >Nom du produit</label>
                <input type="text" id="inputNomProduit" name="nom" class="form-control" maxlength="50" value="<?php echo $produit->getNom() ?>" required/>
            </div>
            <div class="form-group">
                <label for="inputDescProduit" >Description</label>
                <textarea type="text" id="inputDescProduit" name="desc" class="form-control" required><?php echo $produit->getDesc() ?></textarea>
            </div>
            <div class="form-group">
                <label for="inputCategorieProduit" >Catégorie</label>
                <select name="categorie">
                    <?php foreach($categories as $categorie){ ?>
                    <option value="<?php echo $categorie->getId() ?>" <?php echo ($produit->getCategorieID() === $categorie->getId())? 'selected="selected"': ''; ?>><?php echo $categorie->getNom() ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inputPrixProduit">Prix</label>
                <div class="input-group">
                    <input class="form-control" type="money" id="inpuutPrixProduit" name="prix" max="9999.99" min="0000.01" value="<?php echo $produit->getPrix() ?>" required/>
                    <span class="input-group-addon">$ CAD</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputTaxeProduit">Taxe</label>
                <div class="input-group">
                    <input class="form-control" type="number" id="inputTaxeProduit" name="taxe" max="99.99" step="0.01" min="0" value="<?php echo $produit->getTaxe() ?>" required/>
                    <span class="input-group-addon">%</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputImageProduit">Image</label>
                <input type="file" id="inputImageProduit" name="image" />
                <p>Maximum : 5Mo</p>
            </div>
            <div class="form-group">
                <label for="inputAltImageProduit">Légende image</label>
                <input class="form-control" id="inputAltImageProduit" type="text" name="alt" maxlength="50" value="<?php echo preg_replace('#(^\')|(\'$)#', '', $produit->getAltImage()) ?>" />
            </div>
            <input style="width:120px" type="submit" value="<?php echo ($edition)? 'Sauvegarder' : 'Ajouter'; ?>" class="btn btn-success pull-right" name="submit" />
        </form>
    </div>
</div>

<?php include '../../footer.php'; ?>
