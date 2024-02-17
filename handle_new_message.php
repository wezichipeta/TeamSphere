<?php
    require_once('header.php');
?>

<div class='main-body'>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        $message = post_messsge($_SESSION['user']['email'], $_POST['messageBodyInput'], True);
    ?>
    <h3><?=$message?></h3>
    </pre>
    <a href="messages.php">Go back to messages</a>
</div>

<?php require_once('footer.php'); ?>