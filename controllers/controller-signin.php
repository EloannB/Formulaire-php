<?php

session_start();

require_once "../config.php";

require_once "../models/Utilisateur.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $erreurs = array();

    $courriel = htmlspecialchars($_POST['courriel']);
    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);

    if (empty($erreurs["courriel"])) {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);
            // Définir le mode d'erreur sur exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Utilisation de requêtes préparées pour éviter les injections SQL
            $sqlMdpUtilisateur = "SELECT * FROM utilisateur WHERE courriel = ?";
            $query = $db->prepare($sqlMdpUtilisateur);

            // Liaison des paramètres et exécution de la requête
            $query->bindParam(1, $courriel, PDO::PARAM_STR);
            $query->execute();

            // Récupération du résultat de la requête
            $resultat = $query->fetch(PDO::FETCH_ASSOC);

            // Vérification du mot de passe à l'aide de password_verify
            if ($resultat) {
                // Récupération du mot de passe haché depuis la base de données
                $mot_de_passe_bdd = $resultat['mot_de_passe'];

                // Vérification du mot de passe à l'aide de password_verify
                if (password_verify($mot_de_passe, $mot_de_passe_bdd)) {

                    $_SESSION["user"] = $resultat;
                    unset($_SESSION["user"]["Mot_de_passe"]);

                    // Rediriger vers la page d'accueil
                    header("Location: ../controllers/controller-home.php");
                    exit();
                } else {
                    // Mot de passe incorrect
                    if (empty($_POST["mot_de_passe"])) {
                        $erreurs['mot_de_passe'] = "Champs obligatoire.";
                    } else if ($_POST["mot_de_passe"]) {
                        $erreurs['mot_de_passe'] = "Mot de passe incorrect.";
                    }
                }
            } else {
                // Aucun utilisateur trouvé avec cette adresse mail
                if (empty($_POST["courriel"])) {
                    $erreurs['courriel'] = "Champs obligatoire.";
                } else if ($_POST["courriel"]) {
                    $erreurs['courriel'] = "Le nom est invalide.";
                }
            }

            // Fermeture de la requête préparée
            $query->closeCursor();
        } catch (PDOException $e) {
            // Gestion des erreurs de connexion
            $erreurs[] = "Erreur de connexion à la base de données : " . $e->getMessage();
        } finally {
            // Fermeture de la connexion à la base de données
            $db = null;
        }
    }
}




include_once '../views/view-signin.php';
