<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="styles/temoignage.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="./styles/post.css">
    <title>post</title>
</head>

<body>
    <?php
    include 'header.php';

    require_once 'PostManager.php';

    try {
        $postManager = new PostManager("localhost", "root", "root", "philo");
    } catch (Exception $e) {
        die("Error creating PostManager instance: " . $e->getMessage());
    }
    ?>
</body>

</html>
<div class="popup-content">
    <h2 style="color: #000;" >Create a Post</h2>
    <form id="postForm" action="" method="POST">
        <input type="text" name="nom" placeholder="nom">
        <input type="number" name="promos" placeholder="promos">
        <textarea name="post" placeholder="Write your post"></textarea>
        <input type="submit" value="Submit">
    </form>
    <button class="close-button">Close</button>
</div>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming your form fields are named 'nom', 'post', and 'promos'
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $postContent = isset($_POST['post']) ? $_POST['post'] : '';
    $promos = isset($_POST['promos']) ? $_POST['promos'] : '';

    try {
        // Instantiate CreatePost class
        $createPost = $postManager->createNewPost($nom, $promos, $postContent);

        // Uncomment the line below if you want to retrieve the post ID
        // $postId = $createPost->createNewPost($nom, $promos, $postContent);

        // Send a success response
        echo json_encode(['status' => 'success', 'postId' => $createPost]);

        // Redirect to temoiniage.php
        header("Location: temoignage.php");
        exit;
    } catch (Exception $e) {
        // Send an error response
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit;
    }
}
