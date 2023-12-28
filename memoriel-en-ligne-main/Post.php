<?php
// Inclure la classe PostManager
require_once 'PostManager.php';

// Créer une instance de la classe PostManager en passant les informations de connexion
$postManager = new PostManager("localhost", "root", "root", "philo");

// Utiliser la méthode getAllPosts pour récupérer tous les posts
$posts = $postManager->getAllPosts();

?>
