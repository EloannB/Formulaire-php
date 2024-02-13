<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Inscription</title>
</head>

<body>

    <?php if ($showform) { ?>

        <div id="formulaire">
            <form action="controller-signup.php" method="post" novalidate>
                <h1>Formulaire d'inscription</h1>
                <input type="text" id="nom" name="nom" placeholder="Nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                <p class="error"><?= $erreurs["nom"] ?? '' ?></p>
                <input type="text" id="prenom" name="prenom" placeholder="Prénom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
                <p class="error"><?= $erreurs["prénom"] ?? '' ?></p>
                <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" value="<?= htmlspecialchars($_POST['pseudo'] ?? '') ?>" required>
                <p class="error"><?= $erreurs["pseudo"] ?? '' ?></p>
                <input type="email" id="courriel" name="courriel" placeholder="Courriel" value="<?= htmlspecialchars($_POST['courriel'] ?? '') ?>" required>
                <p class="error"><?= $erreurs["courriel"] ?? '' ?></p>
                <input type="date" id="date_naissance" name="date_naissance" placeholder="Date de naissance" value="<?= htmlspecialchars($_POST['date_naissance'] ?? '') ?>" required>
                <p class="error"><?= $erreurs["date_naissance"] ?? '' ?></p>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" required>
                <p class="error"><?= $erreurs["mot_de_passe"] ?? '' ?></p>
                <input type="password" id="conf_mot_de_passe" name="conf_mot_de_passe" placeholder="Confirmer le mot de passe" required>
                <p class="error"><?= $erreurs["conf_mot_de_passe"] ?? '' ?></p>
                <select id="choix_entreprise" name="choix_entreprise" required>
                    <option value="" disabled selected>Sélectionnez une entreprise</option>
                    <?php foreach (Entreprise::getAllEntreprise() as $entreprise) { ?>
                        <option value="<?= $entreprise['id_entreprise'] ?>" <?= isset($_POST['choix_entreprise']) && $_POST['choix_entreprise'] == $entreprise['id_entreprise'] ? 'selected' : '' ?>><?= $entreprise['nom_entreprise'] ?></option>
                    <?php } ?>
                </select>
                <p class="error"><?= $erreurs["choix_entreprise"] ?? '' ?></p>
                <label>
                    <input type="checkbox" name="cgu" <?= isset($_POST['cgu']) ? 'checked' : '' ?> required>
                    J'accepte les conditions générales d'utilisation (CGU)
                </label>
                <p class="error"><?= $erreurs["cgu"] ?? '' ?></p>
                <button type="submit">S'enregistrer</button>
                <div class="text-center">
                <p>Vous avez déjà un compte ? <a href="../controllers/controller-signin.php">Connectez-vous</a></p>
            </div>
            </form>
        </div>
    <?php } else { ?>

        <div style='display: flex; align-items: center; justify-content: center; height: 100vh;'>
            <div class='user-summary' style='border: 1px solid #ccc; padding: 20px; max-width: 400px;'>
                <p style='color:green;'>Inscription réussie ! Un mail de confirmation a été envoyé.</p>
                <div style='padding: 20px;'>
                    <a href='../views/view-signin.php' class='button'>Connexion</a>
                </div>
            </div>
        </div>
    <?php } ?>

</body>

</html>