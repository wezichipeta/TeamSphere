<?php
    require_once('header.php');
?>

<div class='main-body'>
    <?php
        $message = post_messsge($_POST['userEmailInput'], $_POST['messageBodyInput']);
    ?>
    <h3><?=$message?></h3>
    </pre>
    <a href="messages.php">Go back to messages</a>
</div>

<?php require_once('footer.php'); ?>