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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id_trajet = $_POST['id_trajet'];

    // Convertir l'ID du trajet en entier
    $id_trajet = intval($id_trajet);

    // Appel à la fonction de suppression
    Trajet::supprimerTrajet($id_trajet);

    // Rafraîchir la page 
    header('Location: controller-history.php');
    exit();
}

// Inclure la page de vue History
include_once '../views/view-history.php';