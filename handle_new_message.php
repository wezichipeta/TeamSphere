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
            $result = post_message($_POST['messageBodyInput'], 1, null);
        } else {
            $result = post_message($_POST['messageBodyInput'], 0, $queryParameters['chat_id']);
        }
    ?>
    <?php if($isPublicChat) {?>
        <h3><?=$result?></h3>
        </pre>
        <a href="messages.php">Go back to messages</a>
    <?php } else {?>
        <h3><?=$result?></h3>
        </pre>
        <a href="chat.php?chat_id=<?=$queryParameters['chat_id']?>">Go back to chat</a>
    <?php }?>
    
</div>

<?php require_once('footer.php'); ?>