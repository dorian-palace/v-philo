<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles/header.css" />  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>
<body id="accueil">
    <header>
        <div class="logo"><p>Joy Elbaz Lassier-Capon</p></div>
        <ul>
            <li><a href="index.php" id="accueil-link" class="active">Accueil</a></li>
            <li><a href="evenements.php" id="evenements-link">Evénements</a></li>
            <li><a href="travaux.php" id="travaux-link">Travaux</a></li>
            <li><a href="temoignage.php" id="temoignage-link">Témoignage</a></li>
        </ul>
    </header>

    <!-- Ajout js pour que l'animation survol de souris restee sur la bonne page -->
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentPageId = document.body.id;

            // Retirer la classe 'active' de tous les liens
            document.querySelectorAll("header ul li a").forEach(function(link) {
                link.classList.remove("active");
            });

            // Ajouter la classe 'active' au lien correspondant à la page active
            var activeLink = document.getElementById(currentPageId + "-link");
            if (activeLink) {
                activeLink.classList.add("active");
            }
        });
    </script>



</body>
</html>
