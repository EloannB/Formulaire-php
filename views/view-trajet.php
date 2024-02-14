<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Formulaire trajet</title>
</head>

<body>

    <?php if ($showform) { ?>
        <div id="popupForm" class="popup-form">
            <form class="formTrajet" action="../controllers/controller-trajet.php" method="post" enctype="multipart/form-data">
                <label for="date_trajet" id="dateT">Date/Heure du trajet :</label>
                <input type="date" id="dateTrajet" name="date_trajet" required>

                <label for="distance_trajet" id="distanceT">Distance parcourue (en km) :</label>
                <input type="number" step="0.10" id="distanceParcourue" name="distance_trajet" required>

                <label for="temps_trajet" id="tempsT">Durée du trajet (Heures / Minutes) :</label>
                <input type="time" id="dureeTrajet" name="temps_trajet" required>

                <label for="id_vehicule" id="vehiculeT">Vehicule :</label>
                <select id="idVehicule" name="id_vehicule" required>
                    <option value="" disabled selected>Choisir un moyen de transport</option>
                    <?php foreach (Transport::getAllTransport() as $transport) { ?>
                        <option value="<?= $transport['id_transport'] ?>" <?= isset($_POST['id_transport']) && $_POST['id_transport'] == $transport['id_transport'] ? 'selected' : '' ?>><?= $transport['type_transport'] ?></option>
                    <?php } ?>
                </select>
                <span class="error">
                    <?php if (isset($erreurs['id_vehicule'])) {
                        echo $erreurs['id_vehicule'];
                    } ?>
                </span>

                <label for="photo_trajet" id="photoT">Image du trajet (optionnel) :</label>
                <input type="file" id="imageTrajet" name="photo_trajet" accept="image/*">



                <button type="submit">Ajouter</button>
                <div style='margin-top: 10px;'>
                    <a href="controller-home.php" id="arrowleft"><i class="bi bi-arrow-left-circle"></i></a>
                </div>
            </form>
        </div>
    <?php } else { ?>

        <div style='display: flex; align-items: center; justify-content: center; height: 100vh;'>
            <div class='user-summary' style='border: 1px solid #ccc; padding: 20px; max-width: 400px;'>
                <p style='color:green;'>Trajet enregistré avec succès !</p>
                <div style='padding: 20px;'>
                    <a href='../controllers/controller-history.php' class='button'>Voir trajet(s)</a>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>