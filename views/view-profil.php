<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Profil</title>
    <style>
        #updateProfileForm {
            display: none;
        }
    </style>
</head>

<body>

    <div id="profil">
        <h1>Profil</h1>

        <div id="profileInfo">
            <p>Nom de l'Entreprise: <?php echo $_SESSION['user']['nom_entreprise']; ?></p>
            <img src="<?php echo isset($_SESSION['user']['photo']) ? $_SESSION['user']['photo'] : '/pexels-fwstudio-172289.jpg'; ?>" alt="Photo de profil">
            <p>Pseudo: <?php echo $_SESSION['user']['pseudo_participant']; ?></p>
            <p>Nom: <?php echo $_SESSION['user']['nom_participant']; ?></p>
            <p>Prénom: <?php echo $_SESSION['user']['prenom_participant']; ?></p>
            <p>Adresse Mail: <?php echo $_SESSION['user']['mail_participant']; ?></p>
            <p>Date de naissance: <?php echo $_SESSION['user']['naissance_participant']; ?></p>
            <p>Description: <?php echo $_SESSION['user']['description_participant']; ?></p>
            <a href="controller-home.php">Retour à l'accueil</a>
            <button id="editProfileBtn">Modifier le profil</button>
        </div>

        <!-- Formulaire de mise à jour du profil -->
        <form id="updateProfileForm" action="controller-update-profile.php" method="post" enctype="multipart/form-data">
            <label for="nom_entreprise" class="formul-label">Nom de l'Entreprise :</label>
            <input type="text" id="nom_entreprise" name="nom_entreprise" value="<?php echo $_SESSION['user']['nom_entreprise']; ?>" class="form-input">

            <label for="pseudo" class="formul-label">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" value="<?php echo $_SESSION['user']['pseudo_participant']; ?>" class="form-input">

            <label for="nom" class="formul-label">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $_SESSION['user']['nom_participant']; ?>" class="form-input">

            <label for="prenom" class="formul-label">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $_SESSION['user']['prenom_participant']; ?>" class="form-input">

            <label for="adresse_mail" class="formul-label">Adresse Mail :</label>
            <input type="email" id="adresse_mail" name="adresse_mail" value="<?php echo $_SESSION['user']['mail_participant']; ?>" class="form-input">

            <label for="date_naissance" class="formul-label">Date de naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" value="<?php echo $_SESSION['user']['naissance_participant']; ?>" class="form-input">

            <label for="description" class="formul-label">Description :</label>
            <textarea id="description" name="description" class="form-textarea"><?php echo $_SESSION['user']['description_participant']; ?></textarea>

            <label for="profile_image" class="formul-label">Changer la photo de profil :</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-input">

            <img src="<?php echo isset($_SESSION['user']['photo']) ? $_SESSION['user']['photo'] : '/pexels-fwstudio-172289.jpg'; ?>" alt="Photo de profil" class="profile-image">

            <button type="submit" class="majBtn">Mettre à jour</button>
            <button type="button" class="cancelBtn" id="cancelBtn">Annuler</button>
        </form>

    </div>

    <script>
        // Récupérez les éléments du DOM
        const editProfileBtn = document.getElementById('editProfileBtn');
        const profileInfo = document.getElementById('profileInfo');
        const updateProfileForm = document.getElementById('updateProfileForm');
        const cancelUpdateBtn = document.getElementById('cancelBtn');

        // Ajoutez un gestionnaire d'événements pour le clic sur le bouton "Modifier le profil"
        editProfileBtn.addEventListener('click', () => {
            // Masquez les informations du profil
            profileInfo.style.display = 'none';
            // Affichez le formulaire de mise à jour du profil
            updateProfileForm.style.display = 'block';
        });

        // Ajoutez un gestionnaire d'événements pour le clic sur le bouton "Annuler"
        cancelUpdateBtn.addEventListener('click', () => {
            // Affichez les informations du profil
            profileInfo.style.display = 'block';
            // Masquez le formulaire de mise à jour du profil
            updateProfileForm.style.display = 'none';
        });
    </script>
</body>

</html>