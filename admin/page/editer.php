<?php include '../../header.php';

if(!$isUserConnected) {
    header('Location: ../../index.php');
}

if(!$isUserAdmin){
    header('Location: ../../403.php?page=page/editer.php');
}

if(isset($_POST) && !empty($_POST)){
    $page=$_POST['page'];
    file_put_contents($page.'.html', $_POST['editeur']);
    header('Location: ../../index.php');
}else{
    header('Location: ../../index.php');
}

?>
