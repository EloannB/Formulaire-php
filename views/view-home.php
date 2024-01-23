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
        <p>Pseudo de l'utilisateur : <?php echo $_SESSION['pseudo_participant']; ?></p>
        <img src="" alt="Image de profil">
        <button>Ajouter un trajet écologique</button>
        <a href="controller-logout.php">Déconnexion</a>
    </div>

</body>

</html>
