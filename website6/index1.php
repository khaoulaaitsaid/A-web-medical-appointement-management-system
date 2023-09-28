<?php
include("database.php");

// Connexion à la base de données et exécution de la requête
$database_host = "localhost"; // Remplacez par votre hébergeur de base de données
$database_name = "gestion de rendez-vous"; // Remplacez par le nom de votre base de données
$database_user = "root"; // Remplacez par le nom d'utilisateur de la base de données
$database_password = ""; // Remplacez par le mot de passe de la base de données

// Connexion à la base de données
$conn = new mysqli($database_host, $database_user, $database_password, $database_name);

// Vérification des erreurs de connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

// Vérifier si les indices sont définis dans $_POST
if (isset($_POST["nom_medecin"]) && isset($_POST["specialite"])) {
    // Récupérer les valeurs des variables $nom_medecin et $specialite depuis le formulaire
    $nom_medecin = $_POST["nom_medecin"];
    $specialite = $_POST["specialite"];

    // Préparer la requête avec des paramètres pour éviter les injections SQL
    $query_rv = "SELECT nom_patient, date_rv, heure_rv 
                FROM rv
                WHERE nom_medecin = ?";

    // Préparer la requête avec des paramètres
    $stmt = $conn->prepare($query_rv);
    $stmt->bind_param("s", $nom_medecin);
    

    // Exécuter la requête
    $stmt->execute();

    // Obtenir le résultat de la requête
    $result_rv = $stmt->get_result();

    // Vérification du résultat de la requête rv
    if ($result_rv->num_rows > 0) {
        // Affichage des informations
        echo "<h1>Table des rendez-vous</h1>";
        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #eee;'><th style='border: 1px solid black; padding: 5px;'>Nom patient</th><th style='border: 1px solid black; padding: 5px;'>Date du rendez-vous</th><th style='border: 1px solid black; padding: 5px;'>Heure du rendez-vous</th></tr>";
        while ($row = $result_rv->fetch_assoc()) {
            echo "<tr style='border: 1px solid black;'><td style='border: 1px solid black; padding: 5px;'>" . $row["nom_patient"] . "</td><td style='border: 1px solid black; padding: 5px;'>" . $row["date_rv"] . "</td><td style='border: 1px solid black; padding: 5px;'>" . $row["heure_rv"] . "</td></tr>";
        }
        echo "</table>";
        echo "<a href='home.php' class='link-back'>Retour à la page d'accueil</a>";
    } else {
        echo "Il n'y a aucun rendez-vous.";
        echo "<a href='home.php' class='link-back'>Retour à la page d'accueil</a>";
    }

    $stmt->close();
} else {
    echo "Les informations du médecin n'ont pas été fournies.";
    echo "<a href='home.php' class='link-back'>Retour à la page d'accueil</a>";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Liste des rendez-vous</title>
    
</head>
<body></body>
</head>
</html>


<style>
    /* style pour positionner le lien en bas à gauche */
    .link-back {
        position: fixed;
        bottom: 10px;
        left: 10px;
        font-size: 16px;
    }
</style>



