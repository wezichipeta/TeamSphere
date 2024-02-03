<?php
require_once('header.php');

// Sample data for demonstration purposes
$posts = [
    [
        'author' => 'Jane Doe',
        'title' => 'Exploring PHP',
        'content' => 'PHP is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.',
        'details' => 'Web Developer with 5 years of experience in PHP, JavaScript, and CSS.',
    ],
    [
        'author' => 'John Smith',
        'title' => 'PHP and MySQL',
        'content' => 'Combining PHP and MySQL gives you the ability to create complex websites with dynamic and interactive content.',
        'details' => 'Database Administrator with a passion for SQL databases and performance optimization.',
    ],
    // Add more posts as needed
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teamsphere's Community</title>
    <style>
        .container {
            display: flex;
            margin-top: 20px;
        }
        .left-view {
            flex: 1;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .main-view {
            flex: 3;
            padding: 20px;
        }
        .post {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Teamsphere's Community</h1>

<div class="container">
    <div class="left-view">
        <h2>Contributor Details</h2>
        <?php foreach ($posts as $post): ?>
            <p><strong><?= htmlspecialchars($post['author']) ?>:</strong> <?= htmlspecialchars($post['details']) ?></p>
        <?php endforeach; ?>
    </div>
    <div class="main-view">
        <h2>Community Posts</h2>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p><strong>Posted by:</strong> <?= htmlspecialchars($post['author']) ?></p>
                <p><?= htmlspecialchars($post['content']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once('footer.php'); ?>

