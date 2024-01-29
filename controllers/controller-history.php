<?php
session_start();

// Config
require_once "../config.php";

// Models
require_once "../models/Utilisateur.php";
require_once "../models/Trajet.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: controller-signin.php");
    exit();
}

// Récupérer les informations des trajets l'utilisateur depuis la session
$user = $_SESSION['user'];
$trajetUtilisateur = $_SESSION['user']['id_utilisateur'] ? Trajet::getHistoriqueTrajet($_SESSION['user']['id_utilisateur']) : "Trajet non défini";

// Inclure la page de vue History
include_once '../views/view-history.php';