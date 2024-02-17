<?php
    require_once('header.php');
?>

<div class='main-body'>
    <?php
        $response = create_chat($_POST['userId']);
        echo $response;
    ?>
</div>

<?php require_once('footer.php'); ?>
