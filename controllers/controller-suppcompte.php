<?php
session_start();

require_once "../config.php";
require_once "../models/Utilisateur.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: controller-signin.php');
    exit();
}

// Vérifier si le formulaire de suppression a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id_utilisateur'];

    // Appeler la fonction pour supprimer le compte
    Utilisateur::supprimerCompte($user_id);

    // Déconnecter et supprimer l'utilisateur et le rediriger vers la page de connexion
    session_destroy();
    header('Location: controller-signin.php');
    exit();
}

// Rediriger vers la page de profil si le formulaire n'est pas soumis
header('Location: controller-profil.php');
exit();
