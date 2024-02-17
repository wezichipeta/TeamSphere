<?php
    require_once('header.php');
?>

<div class='main-body'>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
        parse_str($_SERVER['QUERY_STRING'], $queryParameters);
        $isPublicChat = $queryParameters['is_public'] == 'true';
        if ($isPublicChat) {
            $result = post_messsge($_POST['messageBodyInput'], true, null);
        } else {
            $result = post_messsge($_POST['messageBodyInput'], true, $queryParameters['chat_id']);
        }
    ?>
    <?php if($isPublicChat) {?>
        <h3><?=$result?></h3>
        </pre>
        <a href="messages.php">Go back to messages</a>
    <?php } else {?>
        <h3><?=$result?></h3>
        </pre>
        <a href="chat.php?chat_id=<?=$queryParameters['chat_id']?>">Go back to messages</a>
    <?php }?>
    
</div>

<?php require_once('footer.php'); ?>