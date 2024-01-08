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

    // Valider les champs


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
    // S'il y a des erreurs
    if (empty($erreurs)) {
        echo "<p style='color:green;'>Inscription réussie ! Un mail de confirmation a été envoyé.</p>";
        echo "<p>Nom: $nom</p>";
        echo "<p>Prénom: $prenom</p>";
        echo "<p>Courriel: $courriel</p>";
        echo "<p>Date de naissance: $date_naissance</p>";
        // Cacher le formulaire 
        $showform = false;     
    }
}

include_once '../views/view-signup.php';
