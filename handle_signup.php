<?php
    require_once('header.php');
?>

<?php
    $birthday= new DateTime( $_POST['birthdayInput']);
    $user_data = [
        'fullname' => $_POST['fullnameInput'],
        'email' => $_POST['emailInput'],
        'location' => $_POST['locationInput'],
        'department' => $_POST['department'],
        'birthday' => $birthday->format('Y-m-d'),
        'password' => $_POST['passwordInput'],
    ];
    
    create_new_user($user_data);
?>

<div class="alert alert-success" role="alert">
    Thank you for signing up and becoming a TeamSpherean, <?= $user_data['fullname']; ?>!<br>
    Please click <a href="login.php">here </a> to log in.
</div>

<?php require_once('footer.php'); ?>