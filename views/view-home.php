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
        <p>Date du jour : <?php echo date('Y-m-d'); ?></p>
        <div class="user-info">
            <img src="/pexels-fwstudio-172289.jpg" alt="Image de profil">
        </div>
        <button class="add-profil" onclick="location.href='controller-profil.php';">Voir le Profil</button>
        <a href="../controllers/controller-trajet.php"><button class="add-btn">Ajouter un trajet écologique</button></a>
        
        <!-- Ajouter le formulaire de déconnexion -->
        <form method="post" style="display:inline;">
            <input type="hidden" name="logout" value="1">
            <button type="submit" class="logout-button">Déconnexion</button>
        </form>
    </div>


</body>

</html>