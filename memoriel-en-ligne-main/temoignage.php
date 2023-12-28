<!DOCTYPE html>
<html lang="fr">

<head>

    <link rel="stylesheet" type="text/css" href="styles/temoignage.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Thèmes de recherche</title>
</head>
<body id="temoignage">
    <a id="post-mot" href="./postComment.php" style="text-decoration: none;">Laisser un mot</a>
    <?php
    include 'header.php';

    require_once 'PostManager.php';

    try {
        $postManager = new PostManager("localhost", "root", "root", "philo");
    } catch (Exception $e) {
        die("Error creating PostManager instance: " . $e->getMessage());
    }

    $postsPerPage = 5;
    $paginationInterval = 3;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    $postsData = $postManager->getPostsByPage($page, $postsPerPage, $paginationInterval);
    $posts = $postsData['posts'];
    ?>

    <div class="comment-container">
        <?php
        foreach ($posts as $post) {
            echo '<div class="comment-session">';
            echo '<div class="post-comment">';
            echo '<div class="list">';
            echo '</div>';
            echo '<div class="comment-post">' . $post['post'] . '</div>';
            echo '</div>';
            echo '<div class="user">';
            echo '<div class="user-meta">';
            echo '<div class="name">Poster par: ' . $post['nom'] . '</div>';
            echo '<div class="day">Promos: ' . $post['promos'] . '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
        <?php
        // Calculate the total number of posts
        $totalPosts = $postsData['totalPosts'];

        // Display pagination links
        $totalPages = ceil($totalPosts / $postsPerPage);

        echo '<div class="pagination">';
        // Previous button
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '" class="prev">&lt;</a>';
        }
        
        // Display a maximum of 3 pages at a time
        $startPage = max(1, $page - 1);
        $endPage = min($totalPages, $startPage + 2);
        
        for ($i = $startPage; $i <= $endPage; $i++) {
            $activeClass = ($i === $page) ? 'active' : '';
            echo '<a href="?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a>';
        
            // Add a separator for pages within the range
         
        }
        
        // Next button
        if ($page < $totalPages) {
            echo '<a href="?page=' . ($page + 1) . '" class="next">&gt;</a>';
        }
        
        echo '</div>';
        
        ?>
</body>

</html>