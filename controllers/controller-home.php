<?php

require_once '../config.php';
require_once '../models/Utilisateur.php';
// controller-home.php

session_start();

// Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session 'id_utilisateur'
if (!isset($_SESSION['id_utilisateur'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: controller-signin.php');
    exit(); // Assurez-vous de terminer le script après une redirection
}

// Inclure la page de vue HOME
include_once '../views/view_home.php';
