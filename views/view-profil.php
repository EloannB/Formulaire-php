<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Profil</title>
</head>

<body>

<div id="profil">
    <h1>Profil</h1>
    <p>Nom de l'Entreprise: <?php echo $user['id_entreprise']; ?></p>
    <img src="<?php echo isset($user['photo']) ? $user['photo'] : '/pexels-fwstudio-172289.jpg'; ?>" alt="Photo de profil">
    <p>Pseudo: <?php echo $user['pseudo_participant']; ?></p>
    <p>Nom: <?php echo $user['nom_participant']; ?></p>
    <p>Prénom: <?php echo $user['prenom_participant']; ?></p>
    <p>Adresse Mail: <?php echo $user['mail_participant']; ?></p>
    <p>Date de naissance: <?php echo $user['naissance_participant']; ?></p>
    <p>Description: <?php echo $user['description_participant']; ?></p>
    <a href="controller-home.php">Retour à l'accueil</a>
</div>

</body>

</html>
