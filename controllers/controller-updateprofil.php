<?php

// Initialisation de la session
session_start();

// Inclure la configuration et les modèles nécessaires
require_once "../config.php";
require_once "../models/Utilisateur.php";
require_once "../models/Trajet.php";
require_once '../models/Entreprise.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: controller-signin.php');
    exit();
}
var_dump($_POST);
// Vérifier si le formulaire de mise à jour a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id_utilisateur'];

    // Récupérer les données du formulaire
    $nomEntreprise = $_POST['choix_entreprise'];
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresseMail = $_POST['adresse_mail'];
    $dateNaissance = $_POST['date_naissance'];
    $description = $_POST['description'];

    // Vérifier si l'image est réellement une image
    if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0) {
        $target_dir = "../assets/uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        var_dump($target_file);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check === false) {
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                // Mettre à jour le chemin de l'image dans la base de données
                Utilisateur::updateUserProfileImage($user_id, $_FILES["profile_image"]["name"]);
            }
        }
    }

    // Mettre à jour les informations du profil
    Utilisateur::updateUserProfile($user_id, $nomEntreprise, $pseudo, $nom, $prenom, $adresseMail, $dateNaissance, $description);

    $_SESSION ['user'] = Utilisateur::getInfos($adresseMail);
}

// Rediriger vers la page de profil
header('Location: controller-profil.php');
exit();

include_once '../views/view-profil.php';
