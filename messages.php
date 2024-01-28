<?php
    require_once('header.php');
    $messages = get_all_messages();
?>

<div class='main-body'>
    <ul>
        <?php foreach($messages as $message): ?>
            <li>
                <div>
                    <?=$message['fullname']?>: <?=$message['body']?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <form action="handle_new_message.php" method="post">
        <div class="mb-3">
            <label for="messageBodyInput" class="form-label">New Message</label>
            <input
                type="text" name="messageBodyInput" class="form-control" id="messageBodyInput"
                aria-describedby="messageBodyInput" placeholder="Type your message"
            >
        </div>
        <div class="mb-3">
            <label for="userEmailInput" class="form-label">Sent by</label>
            <input
                type="text" name="userEmailInput" class="form-control" id="userEmailInput"
                aria-describedby="userEmailInput" placeholder="Your Email"
            >
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>

<?php require_once('footer.php'); ?>
