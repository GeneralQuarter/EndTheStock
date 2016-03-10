<?php

include '../../header.php';
include '../../navbar.php';

if(!$isUserConnected) {
    header('Location: ../../');
}

?>

<?php include '../../footer.php'; ?>