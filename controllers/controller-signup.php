<?php

require_once '../config.php';
require_once '../models/Utilisateur.php';

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
    $valide_participant = 1;

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

        Utilisateur::create($nom, $prenom, $pseudo, $date_naissance, $courriel, $mot_de_passe, $choix_entreprise, $valide_participant);


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
        echo "<button class='btn'>Connexion</button>";
        echo "</div>";
        // Cacher le formulaire 
        $showform = false;
        echo "</div>";
    }
}

include_once '../views/view-signup.php';
