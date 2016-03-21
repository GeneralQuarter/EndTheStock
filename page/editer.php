<?php include '../header.php';

if(!$isUserConnected) {
    header('Location: ../index.php');
}

if(!$isUserAdmin){
    header('Location: ../403.php?page=page/editer.php');
}

if(filter_input(INPUT_POST, 'page', FILTER_SANITIZE_SPECIAL_CHARS) != false){
    $page = (string) filter_input(INPUT_POST, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
    $editeur = (string) filter_input(INPUT_POST, 'editeur');
    file_put_contents($page.'.html', $editeur);
    header('Location: ../index.php');
}else{
    //TODO Message erreur ?
    header('Location: ../index.php');
}
