<?php

class Utilisateur {

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
    public static function create(string $nom, string $prenom, string $pseudo, string $date_naissance, string $courriel, string $mot_de_passe, string $choix_entreprise, int $valide_participant){
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
}