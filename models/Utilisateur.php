<?php

class Utilisateur
{

    /**
     * Méthode permettant de créer un utilisateur
     * @param string $nom Nom de l'utilisateur
     * @param string $prenom Prénom de l'utilisateur
     * @param string $pseudo Pseudo de l'utilisateur
     * @param string $date_naissance Date de naissance de l'utilisateur
     * @param string $courriel Adresse mail de l'utilisateur
     * @param string $mot_de_passe Mot de passe de l'utilisateur
     * @param string $choix_entreprise Id de l'entreprise de l'utilisateur
     * @param string $valide_participant Validation de l'utilisateur
     * 
     * @return void
     */
    public static function create(string $nom, string $prenom, string $pseudo, string $date_naissance, string $courriel, string $mot_de_passe, string $choix_entreprise, int $valide_participant)
    {
        try {

            // Conexion à la base de données
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Stockage de la requete dans variable
            $sql = "INSERT INTO utilisateur (nom_participant, prenom_participant, pseudo_participant, naissance_participant, mail_participant, mdp_participant, id_entreprise, valide_participant)
            VALUES (:lastname, :firstname, :pseudo, :birthdate, :email, :mdp, :id_entreprise, :valide_participant)";

            // Préparation de la requète
            $query = $db->prepare($sql);

            // Relier les valeurs aux marqueurs nominatifs
            $query->bindValue(':lastname', htmlspecialchars($nom), PDO::PARAM_STR);
            $query->bindValue(':firstname', htmlspecialchars($prenom), PDO::PARAM_STR);
            $query->bindValue(':pseudo', htmlspecialchars($pseudo), PDO::PARAM_STR);
            $query->bindValue(':birthdate', $date_naissance, PDO::PARAM_STR);
            $query->bindValue(':email', $courriel, PDO::PARAM_STR);
            $query->bindValue(':mdp', password_hash($mot_de_passe, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $query->bindValue(':id_entreprise', $choix_entreprise, PDO::PARAM_STR);
            $query->bindValue(':valide_participant', $valide_participant, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur :' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de vérifier si un mail existe dans la base de donnée
     * 
     * @param string $email Adresse mail de l'utilisateur
     * 
     * @return bool
     */
    public static function checkMailExists(string $email): bool
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `utilisateur` WHERE `mail_participant` = :mail";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':mail', $email, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on vérifie si le résultat est vide car si c'est le cas, cela veut dire que le mail n'existe pas
            if (empty($result)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de vérifier si un pseudo existe dans la base de donnée
     * 
     * @param string $pseudo Pseudo de l'utilisateur
     * 
     * @return bool
     */
    public static function checkPseudoExists(string $pseudo): bool
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `utilisateur` WHERE `pseudo_participant` = :pseudo";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on vérifie si le résultat est vide car si c'est le cas, cela veut dire que le mail n'existe pas
            if (empty($result)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    /**
     * Methode permettant de récupérer les infos d'un utilisateur avec son mail comme paramètre
     * 
     * @param string $email Adresse mail de l'utilisateur
     * 
     * @return array Tableau associatif contenant les infos de l'utilisateur
     */
    public static function getInfos(string $email): array
    {
        try {
            // Création d'un objet $db selon la classe PDO
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `utilisateur` NATURAL JOIN `entreprise` WHERE `mail_participant` = :mail";

            // je prepare ma requête pour éviter les injections SQL
            $query = $db->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':mail', $email, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on retourne le résultat
            return $result;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    public static function updateUserProfile($utilisateur_id, $nomEntreprise, $pseudo, $nom, $prenom, $adresseMail, $dateNaissance, $user_description)
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            $sql = "UPDATE utilisateur SET id_entreprise = :nomEntreprise, pseudo_participant = :pseudo, nom_participant = :nom, prenom_participant = :prenom, mail_participant = :adresseMail, naissance_participant = :dateNaissance, description_participant = :user_description WHERE id_utilisateur = :utilisateur_id";

            $query = $db->prepare($sql);

            $query->bindParam(":nomEntreprise", $nomEntreprise, PDO::PARAM_STR);
            $query->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
            $query->bindParam(":nom", $nom, PDO::PARAM_STR);
            $query->bindParam(":prenom", $prenom, PDO::PARAM_STR);
            $query->bindParam(":adresseMail", $adresseMail, PDO::PARAM_STR);
            $query->bindParam(":dateNaissance", $dateNaissance, PDO::PARAM_STR);
            $query->bindParam(":user_description", $user_description, PDO::PARAM_STR);
            $query->bindParam(":utilisateur_id", $utilisateur_id, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    public static function updateUserProfileImage($utilisateur_id, $image_user)
    {
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            $sql = "UPDATE utilisateur SET photo_participant = :image_user WHERE id_utilisateur = :id_utilisateur";

            $query = $db->prepare($sql);

            $query->bindParam(":image_user", $image_user, PDO::PARAM_STR);
            $query->bindParam(":id_utilisateur", $utilisateur_id, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }

    public static function supprimerCompte(int $user_id): void
    {
        try {
            // Créer une connexion à la base de données
            $db = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // Supprimer l'utilisateur de la base de données
            $sql = "DELETE FROM `utilisateur` WHERE `id_utilisateur` = :user_id";
            $query = $db->prepare($sql);
            $query->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}
