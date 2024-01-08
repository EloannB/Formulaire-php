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
                <input type="text" name="nom" placeholder="Nom" required>
                <p class="error"><?= $erreurs["nom"] ?? '' ?></p>
                <input type="text" name="prenom" placeholder="Prénom" required>
                <p class="error"><?= $erreurs["prénom"] ?? '' ?></p>
                <input type="email" name="courriel" placeholder="Courriel" required>
                <p class="error"><?= $erreurs["courriel"] ?? '' ?></p>
                <input type="date" name="date_naissance" placeholder="Date de naissance" required>
                <p class="error"><?= $erreurs["date_naissance"] ?? '' ?></p>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
                <p class="error"><?= $erreurs["mot_de_passe"] ?? '' ?></p>
                <input type="password" name="conf_mot_de_passe" placeholder="Confirmer le mot de passe" required>
                <p class="error"><?= $erreurs["mot_de_passe"] ?? '' ?></p>
                <button type="submit">S'enregistrer</button>
            </form>
        </div>

    <?php } ?>

</body>

</html>