<?php
    require_once('header.php');
    $messages = get_all_public_messages();
    $chats = get_all_chats();
    $friendUsers = get_friend_users();
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
?>

<div class='main-body'>
    <div class="container px-4">
        <div class="row">
            <div class="col">

                <h2>Public Message Board</h2>
                <form action="handle_new_message.php?is_public=true" method="post">
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
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
            <?php if(is_user_logged_in()) {?>
                <div class="col">

                    <h2>Private Chats</h2>
                    <form action="handle_new_chat.php" method="post">
                        <div class="mb-3">
                            <label for="messageBodyInput" class="form-label">Start a New Chat</label>
                            <select class="form-select" name="userId" aria-label="Default select example">
                                <?php foreach($friendUsers as $friendUser): ?>
                                    <li class="list-group-item">
                                        <option value="<?=$friendUser['id']?>"><?=$friendUser['fullname']?> (<?=$friendUser['email']?>)</option>
                                    </li>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Start</button>
                    </form>

                    <div style="margin: 30px auto;">
                        <ul class="list-group">
                            <?php foreach($chats as $chat): ?>
                                <li class="list-group-item">
                                    <div>
                                        <a href="chat.php?chat_id=<?=$chat['id']?>">
                                            <?=$chat['name']?>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                </div>
            <?php }?>

        </div>
    </div>
    
</div>

<?php require_once('footer.php'); ?>
