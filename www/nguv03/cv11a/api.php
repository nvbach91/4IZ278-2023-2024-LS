<?php

$url = 'https://jsonplaceholder.typicode.com/users';

$response = file_get_contents($url);

$posts = json_decode($response, true);

// var_dump($posts);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?php foreach($posts as $post): ?>
        <article>
            <h3><?php echo $post['username']; ?></h3>
            <p><?php echo $post['name']; ?></p>
            <p><?php echo $post['email']; ?></p>
        </article>
        <?php endforeach; ?>
    </main>
</body>
</html>