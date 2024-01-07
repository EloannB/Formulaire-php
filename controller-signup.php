<?php
include_once 'view-signup.php';

// Vérifier si le formulaire a été validé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $courriel = htmlspecialchars($_POST['courriel']);
    $date_naissance = htmlspecialchars($_POST['date_naissance']);
    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
    $conf_mot_de_passe = htmlspecialchars($_POST['conf_mot_de_passe']);

    // Valider les champs
    $erreurs = array();

    if (empty($nom) || !ctype_alpha($nom)) {
        $erreurs[] = "Le nom est invalide.";
    }

    if (empty($prenom) || !ctype_alpha($prenom)) {
        $erreurs[] = "Le prénom est invalide.";
    }

    if (empty($courriel) || !filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse e-mail est invalide.";
    }

    if (empty($date_naissance)) {
        $erreurs[] = "La date de naissance est obligatoire.";
    }

    if (empty($mot_de_passe) || strlen($mot_de_passe) < 8 || $mot_de_passe !== $conf_mot_de_passe) {
        $erreurs[] = "Le mot de passe est invalide.";
    }

    // S'il y a des erreurs, les afficher
    if (!empty($erreurs)) {
        foreach ($erreurs as $erreur) {
            echo "<p style='color:red;'>$erreur</p>";
        }
    } else {
        // Afficher le résumé des informations
        echo "<p style='color:green;'>Inscription réussie ! Un mail de confirmation a été envoyé.</p>";
        echo "<p>Nom: $nom</p>";
        echo "<p>Prénom: $prenom</p>";
        echo "<p>Courriel: $courriel</p>";
        echo "<p>Date de naissance: $date_naissance</p>";
        // Cacher le formulaire 
        echo "<script>document.getElementById('formulaire').style.display='none';</script>";
    }
}
?>


