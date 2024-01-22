<?php

require_once '../config.php';
require_once '../models/Utilisateur.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreurs = array();

    $courriel = htmlspecialchars($_POST['courriel']);
    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);

    if (empty($courriel)) {
        $erreurs["courriel"] = "Courriel obligatoire";
    } else if (!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
        $erreurs["courriel"] = "L'adresse e-mail est invalide.";
    }

    if (empty($mot_de_passe)) {
        $erreurs["mot_de_passe"] = "Mot de passe obligatoire";
    } else if (strlen($mot_de_passe) < 8) {
        $erreurs["mot_de_passe"] = "Le mot de passe est invalide.";
    }
}


// Nous déclenchons nos vérifications uniquement lorsqu'un submit de type POST est détecté
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // tableau d'erreurs (stockage des erreurs)
    $errors = [];

    if (empty($_POST['courriel'])) {
        $errors['courriel'] = 'Veuillez saisir votre Email';
    }

    if (empty($_POST['mot_de_passe'])) {
        $errors['mot_de_passe'] = 'Veuillez saisir votre mot de passe';
    }

    if (empty($errors)) {
        // ici commence les tests
        $courriel = $_POST['courriel'];
        $mot_de_passe = $_POST['mot_de_passe'];

        if (!Utilisateur::checkMailExists($courriel)) {
            $errors['courriel'] = 'Utilisateur Inconnu';
        } else {
            // je récupère toutes les infos via la méthode getInfos()
            $utilisateurInfos = Utilisateur::getInfos($courriel);

            // Utilisation de password_verify pour valider le mdp
            if (password_verify($mot_de_passe, $utilisateurInfos['mdp_participant'])) {
                // Mot de passe correct, rediriger vers la page home
                header('Location: controller-home.php');
                exit();
            } else {
                // Mot de passe incorrect, afficher un message d'erreur
                $errors['connexion'] = 'Mot de passe incorrect';
            }
        }
    }
}



include_once '../views/view-signin.php';
