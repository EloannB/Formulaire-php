<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Inscription</title>
</head>
<body>

    <div id="formulaire">
        <form action="controller-signup.php" method="post" novalidate>
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="email" name="courriel" placeholder="Courriel" required>
            <input type="date" name="date_naissance" placeholder="Date de naissance" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <input type="password" name="conf_mot_de_passe" placeholder="Confirmer le mot de passe" required>
            <button type="submit">S'enregistrer</button>
        </form>
    </div>



</body>
</html>


