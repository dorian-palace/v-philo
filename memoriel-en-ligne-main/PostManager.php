<?php
class PostManager
{
    private $connexion;

    // Constructeur : initialise la connexion à la base de données
    public function __construct($serveur, $nomUtilisateur, $motDePasse, $nomBaseDeDonnees)
    {
        try {
            $this->connexion = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees", $nomUtilisateur, $motDePasse);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    // Méthode pour récupérer tous les posts
    public function getAllPosts()
    {
        try {
            $requete = "SELECT * FROM post";
            $resultat = $this->connexion->query($requete);
            return $resultat->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }

    public function createNewPost($nom, $promos, $post)
{
    try {
        $query = "INSERT INTO post (nom, promos, post) VALUES (:nom, :promos, :post)";
        $stmt = $this->connexion->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':promos', $promos);
        $stmt->bindParam(':post', $post);

        // Execute the query
        $stmt->execute();

        // Return the result or success status
        return true;
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la création du post : " . $e->getMessage());
    }
}


    public function getPostsByPage($page, $postsPerPage, $paginationInterval)
    {
        try {
            // Calculate the offset
            $offset = ($page - 1) * $postsPerPage;
            $query = "SELECT * FROM post ORDER BY id DESC LIMIT :limit OFFSET :offset";
            $stmt = $this->connexion->prepare($query);
            $stmt->bindParam(':limit', $postsPerPage, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Calculate the total number of posts
            $queryTotal = "SELECT COUNT(*) as total_posts FROM post";
            $stmtTotal = $this->connexion->query($queryTotal);
            $totalPosts = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total_posts'];

            return [
                'posts' => $posts,
                'totalPosts' => $totalPosts,
                'paginationInterval' => $paginationInterval,
            ];
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des posts : " . $e->getMessage());
        }
    }





    // Vous pouvez ajouter d'autres méthodes pour gérer d'autres opérations sur les posts ici
}
