<?php
    require_once('header.php');
?>

<div class='main-body container'>
    <a href='messages.php'>&lt;Back to messages</a>
    <?php
        $messages = [];
        $queryParameters = array();
        parse_str($_SERVER['QUERY_STRING'], $queryParameters);
        if (!array_key_exists('chat_id', $queryParameters)) {
            echo 'Chat not found';
        } else {
            $chatId = $queryParameters['chat_id'];
            $messages = get_messages_by_chat_id($chatId);
            if (!count($messages)) {
                echo "You don't have access to this chat";
            }
        }
    ?>
    <form action="handle_new_message.php?is_public=false&chat_id=<?=$chatId?>" method="post">
        <div class="mb-3">
            <label for="messageBodyInput" class="form-label">New Message</label>
            <input
                type="text" name="messageBodyInput" class="form-control" id="messageBodyInput"
                aria-describedby="messageBodyInput" placeholder="Type your message"
            >
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>

    <div style="margin: 30px auto;">
        <div class="box-footer box-comments" style="display: block;">
            <?php foreach($messages as $message): ?>
                <div class="box-comment">
                    <div class="<?=is_user_logged_in() && $message['sent_by'] == $_SESSION['user']['user_id'] ? 'text-end' : ''?>">
                        <span class="username">
                            <?=$message['fullname']?>
                            <span class="text-muted pull-right">
                                <?=timestamp_to_datetime($message['sent_ts'])?>
                            </span>
                        </span>
                            <?=$message['body']?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
