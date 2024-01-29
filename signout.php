<?php
    require_once('header.php');
    session_destroy();
    header('Location: signin.php');
?>

<?php require_once('footer.php'); ?>