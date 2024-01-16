<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreurs = array();

    $courriel = htmlspecialchars($_POST['courriel']);
    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);

if (empty($courriel)) {
    $erreurs["courriel"] = "Courriel obligatoire";
} else if (!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
    $erreurs["courriel"] = "L'adresse e-mail est invalide.";
};

if (empty($mot_de_passe)) {
    $erreurs["mot_de_passe"] = "Mot de passe obligatoire";
} else if (strlen($mot_de_passe) < 8) {
    $erreurs["mot_de_passe"] = "Le mot de passe est invalide.";
}
}
include_once '../views/view-signin.php';