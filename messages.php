<?php
    require_once('header.php');
    $messages = get_all_public_messages();
    $chats = get_all_chats();
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
?>

<div class='main-body'>
    <div class="container px-4">
        <div class="row">
            <div class="col">
                <h2>Public Message Board</h2>
                <ul class="list-group">
                    <?php foreach($messages as $message): ?>
                        <li class="list-group-item">
                            <div>
                                <?=$message['fullname']?>: <?=$message['body']?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div style="margin: 30px auto;">
                    <form action="handle_new_message.php" method="post">
                        <div class="mb-3">
                            <label for="messageBodyInput" class="form-label">New Message</label>
                            <input
                                type="text" name="messageBodyInput" class="form-control" id="messageBodyInput"
                                aria-describedby="messageBodyInput" placeholder="Type your message"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <h2>Private Chats</h2>
                <ul class="list-group">
                    <?php foreach($chats as $chat): ?>
                        <li class="list-group-item">
                            <div>
                                <?=$chat['name']?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    
</div>

<?php require_once('footer.php'); ?>
