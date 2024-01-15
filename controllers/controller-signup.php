<?php
$showform = true;
// Vérifier si le formulaire a été validé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreurs = array();
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $courriel = htmlspecialchars($_POST['courriel']);
    $date_naissance = htmlspecialchars($_POST['date_naissance']);
    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
    $conf_mot_de_passe = htmlspecialchars($_POST['conf_mot_de_passe']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $choix_entreprise = htmlspecialchars($_POST['choix_entreprise'] ?? '');

    // Valider les champs
    if (!isset($_POST['cgu'])) {
        $erreurs["cgu"] = "Vous devez accepter les conditions générales d'utilisation.";
    }

    if (empty($nom)) {
        $erreurs["nom"] = "Nom obligatoire";
    } else if (!ctype_alpha($nom)) {
        $erreurs["nom"] = "Le nom est invalide.";
    }

    if (empty($prenom)) {
        $erreurs["prénom"] = "Prénom obligatoire";
    } else if (!ctype_alpha($prenom)) {
        $erreurs["prénom"] = "Le prénom est invalide.";
    };

    if (empty($courriel)) {
        $erreurs["courriel"] = "Courriel obligatoire";
    } else if (!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
        $erreurs["courriel"] = "L'adresse e-mail est invalide.";
    };

    if (empty($date_naissance)) {
        $erreurs["date_naissance"] = "La date de naissance est obligatoire.";
    }

    if (empty($mot_de_passe)) {
        $erreurs["mot_de_passe"] = "Mot de passe obligatoire";
    } else if (strlen($mot_de_passe) < 8 || $mot_de_passe !== $conf_mot_de_passe) {
        $erreurs["mot_de_passe"] = "Le mot de passe est invalide.";
    }

    if (empty($pseudo)) {
        $erreurs["pseudo"] = "Pseudo obligatoire";
    } else if (strlen($pseudo) < 4) {
        $erreurs["pseudo"] = "Le pseudo est invalide. Il doit contenir au moins 4 caractères.";
    }

    if (empty($choix_entreprise)) {
        $erreurs["choix_entreprise"] = "Veuillez choisir une entreprise";
    }
    // Si il n'y a pas d'erreurs
    if (empty($erreurs)) {


        try {

            $dbName = 'metro_boulot_dodo';
            $dbUser = 'ecoride';
            $dbPassword = 'ecoride';
            // Conexion à la base de données
            $db = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Stockage de la requete dans variable
            $sql = "INSERT INTO utilisateur (nom_participant, prenom_participant, pseudo_participant, naissance_participant, mail_participant, mdp_participant, id_entreprise, valide_participant)
            VALUES (:lastname, :firstname, :pseudo, :birthdate, :email, :mdp, :id_entreprise, :valide_participant)";

            // Préparation de la requète
            $query = $db->prepare($sql);

            // Relier les valeurs aux marqueurs nominatifs
            $query->bindValue(':lastname', $nom, PDO::PARAM_STR);
            $query->bindValue(':firstname', $prenom, PDO::PARAM_STR);
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $query->bindValue(':birthdate', $date_naissance, PDO::PARAM_STR);
            $query->bindValue(':email', $courriel, PDO::PARAM_STR);
            $query->bindValue(':mdp', password_hash($mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $query->bindValue(':id_entreprise', $choix_entreprise, PDO::PARAM_STR);
            $query->bindValue(':valide_participant', 1, PDO::PARAM_INT);

            $query->execute();
            
        } catch (PDOException $e) {
            echo 'Erreur :' . $e->getMessage();
            die();
        }

        // Inclure la connexion à la base de données
        // $sql_entreprise = 'SELECT * FROM `entreprise`';

        // Préparation de la requète
        // $query = $db->prepare($sql_entreprise);

        // Executer la requète
        // $query->execute();

        // Stocker le résultat
        // $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($result);



        echo "<div style='display: flex; align-items: center; justify-content: center; height: 100vh;'>";
        echo "<div class='user-summary' style='border: 1px solid #ccc; padding: 20px; max-width: 400px;'>";
        echo "<p style='color:green;'>Inscription réussie ! Un mail de confirmation a été envoyé.</p>";
        echo "<p>Nom: <span>$nom</span></p>";
        echo "<p>Prénom: <span>$prenom</span></p>";
        echo "<p>Pseudo: <span>$pseudo</span></p>";
        echo "<p>Courriel: <span>$courriel</span></p>";
        echo "<p>Date de naissance: <span>$date_naissance</span></p>";
        echo "<p>Entreprise: <span>$choix_entreprise</span></p>";
        echo "</div>";
        // Cacher le formulaire 
        $showform = false;
        echo "</div>";
    }
}

include_once '../views/view-signup.php';
