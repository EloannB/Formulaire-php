<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des trajets</title>
</head>

<body>
    <h1>Historique des trajets :</h1>
    <?php
    // Vérifiez si l'historique contient des trajets
    if (!empty($trajetUtilisateur)) {
        // Affichez chaque trajet à l'aide d'une boucle foreach
        foreach ($trajetUtilisateur as $trajet) {
            echo '<div class="trajet">';
            echo '<p>Date du trajet: ' . $trajet['date_fr'] . '</p>';
            echo '<p>Distance parcourue: ' . $trajet['distance_trajet'] . ' km</p>';
            echo '<p>Durée du trajet: ' . $trajet['temps_trajet'] . '</p>';
            echo '<p>Véhicule: ' . $trajet['id_transport'] . '</p>';
            echo '<img src="' . $trajet['photo_trajet'] . '" alt="Photo du trajet">';
            echo '</div>';
        }
    } else {
        echo '<p>Aucun trajet disponible.</p>';
    }
    ?>
</body>

</html>