<?php

session_start();

require_once "../config.php";

require_once "../models/Utilisateur.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreurs = array();


    // On regarder si les champs sont vides
    if (empty($_POST["courriel"])) {
        $erreurs['courriel'] = "Mail obligatoire.";
    }

    if (empty($_POST["mot_de_passe"])) {
        $erreurs['mot_de_passe'] = "Mot de passe obligatoire.";
    }

    $recaptcha_secret = '6Le6NHEpAAAAAFKmIFb0wsoB4GlBZIRLaDWQpAZ3';

    // Vérifier si le reCAPTCHA a été soumis
    if(isset($_POST['g-recaptcha-response'])){
        // Récupérer la réponse du reCAPTCHA
        $captcha_response = $_POST['g-recaptcha-response'];
        // Effectuer une requête POST à l'API de validation reCAPTCHA
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$captcha_response");
        $responseKeys = json_decode($response, true);
        // Vérifier si la réponse est valide
        if(intval($responseKeys["success"]) !== 1) {
            // Le reCAPTCHA n'a pas été validé
            $erreurs["g-recaptcha-response"] = "Veuillez valider le reCAPTCHA.";
        }
    }

    if (empty($erreurs)) {
        $courriel = htmlspecialchars($_POST['courriel']);
        $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);

        if (Utilisateur::checkMailExists($courriel)) {
            $utilisateurInfos = Utilisateur::getInfos($courriel);

            // On vérifie le mot de passe
            if (password_verify($mot_de_passe, $utilisateurInfos['mdp_participant'])) {
                $_SESSION['user'] = $utilisateurInfos;
                header('Location: controller-home.php');
                exit(); // Assurez-vous de terminer le script après une redirection
            } else {
                $erreurs['mot_de_passe'] = "Mot de passe incorrect.";
            }
        } else {
            $erreurs['courriel'] = "Adresse mail incorrecte.";
        }
    }

}





include_once '../views/view-signin.php';
