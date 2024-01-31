<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Historique des trajets</title>
</head>

<body>
    <a href="controller-home.php" id="arrowleft"><i class="bi bi-arrow-left-circle"></i></a>
    <h1 class="trajHistory">Historique des trajets :</h1>

    <?php
    // Vérifiez si l'historique contient des trajets
    if (!empty($trajetUtilisateur)) {
        // Affichez chaque trajet à l'aide d'une boucle foreach
        foreach ($trajetUtilisateur as $trajet) : ?>
            <div class="trajet">
                <p class="date-trajet">Date du trajet: <?= $trajet['date_fr'] ?></p>
                <p class="distance-trajet">Distance parcourue: <?= $trajet['distance_trajet'] ?> km</p>
                <p class="duree-trajet">Durée du trajet: <?= $trajet['temps_trajet'] ?></p>
                <p class="vehicule-trajet">Véhicule: <?= $trajet['type_transport'] ?></p>
                <img class="photo-trajet" src="<?= $trajet['photo_trajet'] ?>" alt="Photo du trajet">

                <!-- Formulaire de suppression -->
                <form action="controller-history.php" method="post">
                    <input type="hidden" name="id_trajet" value="<?= $trajet['id_trajet'] ?>">
                    <button type="submit" class="btn-delete-trajet"><i class="bi bi-trash3-fill"></i></button>
                </form>
            </div>
    <?php endforeach;
    } else {
        echo '<p class="no-trajet">Aucun trajet disponible.</p>';
    }
    ?>

</body>

</html>