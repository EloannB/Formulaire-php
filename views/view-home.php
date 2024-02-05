<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Home</title>
</head>

<body>

    <div id="home">
        <h1>Bonjour <?php echo $_SESSION['user']['pseudo_participant']; ?></h1>
        <p>Date du jour : <?php echo date('d/m/Y'); ?></p>
        <div class="user-info">
            <?php
            // Vérifie si l'image de profil est définie
            if (!empty($_SESSION['user']['photo_participant'])) {
                $photoPath = "../assets/uploads/" . $_SESSION['user']['photo_participant'];
            } else {
                // Image par défaut si aucune image de profil n'est définie
                $photoPath = "../imageDefaut.png";
            }
            ?>

            <img src="<?= $photoPath ?>" alt="Photo de profil">

        </div>
        <button class="add-profil" onclick="location.href='controller-profil.php';">Voir le Profil</button>
        <a href="../controllers/controller-trajet.php"><button class="add-btn">Ajouter un trajet écologique</button></a>
        <a href="../controllers/controller-history.php"><button class="add-btn">Voir historique des trajets</button></a>

        <!-- Ajouter le formulaire de déconnexion -->
        <form method="post" style="display:inline;">
            <input type="hidden" name="logout" value="1">
            <button type="submit" class="logout-button">Déconnexion</button>
        </form>
    </div>


</body>

</html>