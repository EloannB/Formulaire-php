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
        <h1>Bienvenue sur la page HOME</h1>
        <p>Date du jour : <?php echo date('Y-m-d'); ?></p>
        <div class="user-info">
            <p>Pseudo : <?php echo $_SESSION['user']['pseudo_participant']; ?></p>
            <img src="/pexels-fwstudio-172289.jpg" alt="Image de profil">
        </div>
        <button class="add-trip-btn">Ajouter un trajet écologique</button>
        <a href="controller-logout.php" class="logout-link">Déconnexion</a>
    </div>


</body>

</html>