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
        <ul class="list-group">
            <?php foreach($messages as $message): ?>
                <li class="list-group-item">
                    <div>
                        <?=$message['fullname']?>: <?=$message['body']?>
                    </div>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>

<?php require_once('footer.php'); ?>
