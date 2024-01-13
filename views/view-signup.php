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
        <h1>Formulaire d'inscription :</h1>
        <div id="formulaire">
            <form action="controller-signup.php" method="post" novalidate>
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
                    <option value="entreprise1" <?= isset($_POST['choix_entreprise']) && $_POST['choix_entreprise'] == 'entreprise1' ? 'selected' : '' ?>>Entreprise 1</option>
                    <option value="entreprise2" <?= isset($_POST['choix_entreprise']) && $_POST['choix_entreprise'] == 'entreprise2' ? 'selected' : '' ?>>Entreprise 2</option>
                </select>
                <label>
                    <input type="checkbox" name="cgu" <?= isset($_POST['cgu']) ? 'checked' : '' ?> required>
                    J'accepte les conditions générales d'utilisation (CGU)
                </label>
                <p class="error"><?= $erreurs["cgu"] ?? '' ?></p>
                <button type="submit">S'enregistrer</button>
            </form>
        </div>
    <?php } ?>

</body>

</html>