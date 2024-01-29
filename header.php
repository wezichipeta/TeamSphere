<?php
    session_start();
    require_once('functions.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TeamSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="resources/css/style.css?333" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="resources/js/jquery.validate.min.js"></script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="resources/images/teamsphere-logo.png" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./signup.php">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./messages.php">Messages</a>
                </li>
            </ul>
            <?php if ($_SESSION && array_key_exists('user', $_SESSION) && $_SESSION['user']): ?>
                <form class="form-inline my-2 my-lg-0">
                    <?= $_SESSION['user']['fullname']; ?>&nbsp;&nbsp;
                    <img class="img-thumbnail rounded-circle" style="width: 50px; height: 50px;" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(30).jpg">
                </form>
            <?php else: ?>
                <a class="sign-in" href="signin.php">Sign In</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container-fluid">
