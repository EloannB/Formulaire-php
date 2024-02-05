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

        <div id="profileInfo" class="user-profile">
            <p class="profile-info-item">Nom de l'Entreprise: <?php echo $_SESSION['user']['nom_entreprise']; ?></p>
            <?php
            // Vérifie si l'image de profil est définie
            if (!empty($_SESSION['user']['photo_participant'])) {
                $photoPath = "../assets/uploads/" . $_SESSION['user']['photo_participant'];
            } else {
                // Image par défaut si aucune image de profil n'est définie
                $photoPath = "../imageDefaut.png";
            }
            ?>
            <img src="<?= $photoPath ?>" alt="Photo de profil" class="profile-image">
            <p class="profile-info-item">Pseudo: <?php echo $_SESSION['user']['pseudo_participant']; ?></p>
            <p class="profile-info-item">Nom: <?php echo $_SESSION['user']['nom_participant']; ?></p>
            <p class="profile-info-item">Prénom: <?php echo $_SESSION['user']['prenom_participant']; ?></p>
            <p class="profile-info-item">Adresse Mail: <?php echo $_SESSION['user']['mail_participant']; ?></p>
            <p class="profile-info-item">Date de naissance: <?php echo $_SESSION['user']['naissance_participant']; ?></p>
            <p class="profile-info-item">Description: <?php echo $_SESSION['user']['description_participant']; ?></p>
            <a href="controller-home.php" class="profile-info-link">Retour à l'accueil</a>
            <button id="editProfileBtn" class="profile-info-button">Modifier le profil</button>
        </div>


        <!-- Formulaire de mise à jour du profil -->
        <form id="updateProfileForm" action="controller-updateprofil.php" method="post" enctype="multipart/form-data">
            <label for="choix_entreprise" class="formul-label">Nom de l'Entreprise :</label>
            <select id="choix_entreprise" name="choix_entreprise" class="select-input" required>
                <option value="" disabled selected>Sélectionnez une entreprise</option>
                <?php foreach (Entreprise::getAllEntreprise() as $entreprise) { ?>
                    <option value="<?= $entreprise['id_entreprise'] ?>" <?= isset($_SESSION['user']['id_entreprise']) && $_SESSION['user']['id_entreprise'] == $entreprise['id_entreprise'] ? 'selected' : '' ?>><?= $entreprise['nom_entreprise'] ?></option>
                <?php } ?>
            </select>

            <label for="pseudo" class="formul-label">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" value="<?php echo $_SESSION['user']['pseudo_participant']; ?>" class="form-input">
            <p class="error"><?= $erreurs["pseudo"] ?? '' ?></p>

            <label for="nom" class="formul-label">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo $_SESSION['user']['nom_participant']; ?>" class="form-input">

            <label for="prenom" class="formul-label">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $_SESSION['user']['prenom_participant']; ?>" class="form-input">

            <label for="adresse_mail" class="formul-label">Adresse Mail :</label>
            <input type="email" id="adresse_mail" name="adresse_mail" value="<?php echo $_SESSION['user']['mail_participant']; ?>" class="form-input">
            <span class="error-message"><?php echo isset($emailError) ? $emailError : ''; ?></span>

            <label for="date_naissance" class="formul-label">Date de naissance :</label>
            <input type="date" id="date_naissance" name="date_naissance" value="<?php echo $_SESSION['user']['naissance_participant']; ?>" class="form-input">

            <label for="description" class="formul-label">Description :</label>
            <textarea id="description" name="description" class="form-textarea"><?php echo $_SESSION['user']['description_participant']; ?></textarea>

            <label for="profile_image" class="formul-label">Changer la photo de profil :</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-input">

            <?php
            // Vérifie si l'image de profil est définie
            if (!empty($_SESSION['user']['photo_participant'])) {
                $photoPath = "../assets/uploads/" . $_SESSION['user']['photo_participant'];
            } else {
                // Image par défaut si aucune image de profil n'est définie
                $photoPath = "../imageDefaut.png";
            }
            ?>

            <img src="<?= $photoPath ?>" alt="Photo de profil" class="profile-image">

            <button type="submit" class="majBtn">Mettre à jour</button>
            <button type="button" class="cancelBtn" id="cancelBtn">Annuler</button>
        </form>

        <!-- Formulaire suppression du profil -->
        <form action="controller-suppcompte.php" method="post">
            <button class="supCompte" type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')">Supprimer mon compte</button>
        </form>

    </div>

    <script>
        // Récupérez les éléments du DOM
        const editProfileBtn = document.getElementById('editProfileBtn');
        const profileInfo = document.getElementById('profileInfo');
        const updateProfileForm = document.getElementById('updateProfileForm');
        const cancelUpdateBtn = document.getElementById('cancelBtn');

        // Afficher le formulaire de modification si des erreurs sont présentes
        if (<?= !empty($errors) ? 'true' : 'false' ?>) {
                    document.getElementById('updateProfileForm').style.display = 'block';
                    document.querySelector('profileInfo').style.display = 'none';
                }

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