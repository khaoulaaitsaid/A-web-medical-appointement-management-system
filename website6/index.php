<?php
    include ("database.php");
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestion de rendez-vous";
    $conn = "";

    try {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    } catch(mysqli_sql_exception $e) {
        echo "Erreur : ".$e->getMessage();
    }

    $sql = "SELECT nom_patient, nom_medecin, telephone, date_rv, heure_rv FROM `rv`";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Affichage des rendez-vous
        echo "<h1>Table des rendez-vous</h1>";
        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #eee;'><th style='border: 1px solid black; padding: 5px;'>Nom patient</th><th style='border: 1px solid black; padding: 5px;'>Nom médecin</th><th style='border: 1px solid black; padding: 5px;'>Téléphone du patient</th><th style='border: 1px solid black; padding: 5px;'>Date du rendez-vous</th><th style='border: 1px solid black; padding: 5px;'>Heure du rendez-vous</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr style='border: 1px solid black;'><td style='border: 1px solid black; padding: 5px;'>" . $row["nom_patient"] . "</td><td style='border: 1px solid black; padding: 5px;'>" . $row["nom_medecin"] . "</td><td style='border: 1px solid black; padding: 5px;'>" . $row["telephone"] . "</td><td style='border: 1px solid black; padding: 5px;'>" . $row["date_rv"] . "</td><td style='border: 1px solid black; padding: 5px;'>" . $row["heure_rv"] . "</td></tr>";
        }
        echo "</table>";
        echo "<a href='home.php' class='link-back'>Retour à la page d'accueil</a>";
    } else {
        echo "<h1>Table des rendez-vous</h1>";
        echo "Il n'y a aucun rendez-vous.";
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

