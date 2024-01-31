<?php
session_start();

// Config
require_once "../config.php";

// Models
require_once "../models/Utilisateur.php";
require_once "../models/Trajet.php";
require_once "../models/Transport.php";

$showform = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    // Récupérer les données du formulaire
    $dateTrajet = $_POST["date_trajet"];
    $distanceParcourue = $_POST["distance_trajet"];
    $dureeTrajet = $_POST["temps_trajet"];
    $idVehicule = $_POST["id_vehicule"];
    $idUtilisateur = $_SESSION["user"]["id_utilisateur"];
    // Vérifier si une image a été téléchargée
    $imageTrajet = isset($_FILES["trajet"]) ? $_FILES["trajet"]["name"] : "image.jpg";

    Trajet::ajouterTrajet(
        $dateTrajet,
        $distanceParcourue,
        $dureeTrajet,
        $imageTrajet,
        $idVehicule,
        $idUtilisateur
    );

    $showform = false;
    // Utilisation d'une session pour stocker le message
    // $_SESSION['message'] = "Le trajet a été enregistré avec succès.";

    // Redirection après traitement
    // header("Location: ../controllers/controller-home.php");
    // exit();
}

include("../views/view-trajet.php");