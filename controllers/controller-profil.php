<?php

session_start();

require_once "../config.php";
require_once "../models/Utilisateur.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: controller-signin.php");
    exit();
}

// Récupérer les informations de l'utilisateur depuis la session
$user = $_SESSION['user'];


include_once '../views/view-profil.php';