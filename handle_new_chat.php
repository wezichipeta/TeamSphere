<?php
    require_once('header.php');
?>

<div class='main-body'>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        print_r($_POST)
    ?>
</div>

<?php require_once('footer.php'); ?>