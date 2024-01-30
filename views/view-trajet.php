<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Formulaire trajet</title>
</head>

<body>

<?php if ($showform) { ?>
    <div id="popupForm" class="popup-form">
        <form class="formTrajet" action="../controllers/controller-trajet.php" method="post"
            enctype="multipart/form-data">
            <label for="date_trajet" id="dateT">Date/Heure du trajet :</label>
            <input type="datetime-local" id="dateTrajet" name="date_trajet" required>

            <label for="distance_trajet" id="distanceT">Distance parcourue (en km) :</label>
            <input type="number" step="0.10" id="distanceParcourue" name="distance_trajet" required>

            <label for="temps_trajet" id="tempsT">Durée du trajet :</label>
            <input type="time" id="dureeTrajet" name="temps_trajet" required>

            <label for="id_vehicule" id="vehiculeT">Vehicule :</label>
            <select id="idVehicule" name="id_vehicule" required>
                <option value="" disabled selected>Choisir un moyen de transport</option>
                <option value="1" <?php if (!empty($idVehicule) && $idVehicule == "Velo") {
                    echo "Velo";
                } ?>> Vélo
                </option>
                <option value="2" <?php if (!empty($idVehicule) && $idVehicule == "Trottinette ") {
                    echo "Trottinette";
                } ?>>Trottinette</option>
                <option value="3" <?php if (!empty($idVehicule) && $idVehicule == "Marche") {
                    echo "Marche";
                } ?>>Marche</option>
                <option value="4" <?php if (!empty($idVehicule) && $idVehicule == "Rollers ") {
                    echo "Rollers";
                } ?>>Rollers</option>
                <option value="5" <?php if (!empty($idVehicule) && $idVehicule == "Skate ") {
                    echo "Skate";
                } ?>>Skate</option>
            </select>
            <span class="error">
                <?php if (isset($erreurs['id_vehicule'])) {
                    echo $erreurs['id_vehicule'];
                } ?>
            </span>

            <label for="photo_trajet" id="photoT">Image du trajet (optionnel) :</label>
            <input type="file" id="imageTrajet" name="photo_trajet" accept="image/*">



            <button type="submit">Ajouter</button>
            <a href="controller-home.php" class="profile-info-link">Retour</a>
        </form>
    </div>
    <?php } else { ?>

<div style='display: flex; align-items: center; justify-content: center; height: 100vh;'>
    <div class='user-summary' style='border: 1px solid #ccc; padding: 20px; max-width: 400px;'>
        <p style='color:green;'>Trajet enregistré avec succès !</p>
        <div style='padding: 20px;'>
            <a href='../controllers/controller-profil.php' class='button'>Retour au profil</a>
        </div>
    </div>
</div>
<?php } ?>
</body>

</html>