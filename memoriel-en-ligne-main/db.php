<?php
// Informations de connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$nomUtilisateur = "root"; // Nom d'utilisateur MySQL
$motDePasse = "root"; // Mot de passe MySQL
$nomBaseDeDonnees = "philo"; // Nom de la base de données

try {
    // Création de la connexion PDO
    $connexion = new PDO("mysql:host=$serveur;dbname=$nomBaseDeDonnees", $nomUtilisateur, $motDePasse);

    // Configuration des options PDO
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Votre code de traitement de base de données ici...
        // Requête SQL pour sélectionner tous les posts
        $requete = "SELECT * FROM post";
        $resultat = $connexion->query($requete);

    // Fermer la connexion lorsque vous avez terminé
    $connexion = null;
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher un message d'erreur
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
