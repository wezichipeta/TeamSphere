<?php
require_once('header.php');
session_start(); // Start the session to track likes

// Initialize likes in session if not already set
if (!isset($_SESSION['likes'])) {
    $_SESSION['likes'] = array_fill(0, 5, 0); // Adjust based on the number of posts you're initializing
    // Simulate initial random likes for each post
    for ($i = 0; $i < 5; $i++) {
        $_SESSION['likes'][$i] += rand(10, 100);
    }
}

// Handle like action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like'])) {
    $postIndex = $_POST['like']; // Get the index of the post that was liked
    $_SESSION['likes'][$postIndex]++;
}

// Sample data for demonstration purposes, added more posts
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
    // Added more posts
    [
        'author' => 'Alice Johnson',
        'title' => 'The Basics of Web Security',
        'content' => 'Understanding web security is essential for creating safe and reliable web applications.',
        'details' => 'Security Analyst with a focus on web application vulnerabilities.',
    ],
    [
        'author' => 'Mark Lee',
        'title' => 'Introduction to JavaScript',
        'content' => 'JavaScript is a powerful scripting language that enables interactive web pages.',
        'details' => 'Front-end Developer specializing in modern JavaScript frameworks.',
    ],
    [
        'author' => 'Emily Davis',
        'title' => 'Responsive Web Design',
        'content' => 'Learn how to build websites that work beautifully on all screen sizes.',
        'details' => 'UI/UX Designer with a passion for creating user-friendly designs.',
    ],
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
        form.like-form {
            display: inline;
        }
    </style>
</head>
<body>

<h1>Teamsphere's Community</h1>

<div class="container">
    <div class="left-view">
        <h2>Contributor Details</h2>
        <?php foreach ($posts as $index => $post): ?>
            <p><strong><?= htmlspecialchars($post['author']) ?>:</strong> <?= htmlspecialchars($post['details']) ?></p>
        <?php endforeach; ?>
    </div>
    <div class="main-view">
        <h2>Community Posts</h2>
        <?php foreach ($posts as $index => $post): ?>
            <div class="post">
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <p><strong>Posted by:</strong> <?= htmlspecialchars($post['author']) ?></p>
                <p><?= htmlspecialchars($post['content']) ?></p>
                <p><strong>Likes:</strong> <?= $_SESSION['likes'][$index] ?> 
                <form method="post" action="" class="like-form">
                    <button type="submit" name="like" value="<?= $index ?>">Like</button>
                </form></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once('footer.php'); ?>

</body>
</html>
