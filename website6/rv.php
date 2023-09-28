<?php
include("database.php");
include("header.html");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion de rendez-vous";
$conn = "";

try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    echo "Erreur : " . $e->getMessage();
}

// Récupération des données du formulaire
$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$date = isset($_POST["date"]) ? $_POST["date"] : "";
$heure = isset($_POST["heure"]) ? $_POST["heure"] : "";
$telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
$specialite = isset($_POST["specialite"]) ? $_POST["specialite"] : "";

if (!empty($nom) && !empty($prenom) && !empty($date) && !empty($heure) && !empty($telephone) && !empty($specialite)) {
    // Vérification de l'existence du rendez-vous dans la table rv
    if (!isAppointmentExist($conn, $date, $heure)) {
        // Vérification de la date
        $currentDate = date("Y-m-d");
        if ($date >= $currentDate) {
            // Vérification de l'heure et du médecin
            $medecin_query = "SELECT nom_med FROM medecin WHERE specialite='$specialite'";
            $result = mysqli_query($conn, $medecin_query);
            if ($result && mysqli_num_rows($result) > 0) {
                $medecinData = mysqli_fetch_assoc($result);
                $medecin = $medecinData['nom_med'];
                $medecin=trim($medecin);
                if (!isAppointmentExist($conn, $medecin, $heure)) {
                    // Vérification des jours de la semaine (samedi et dimanche)
                    $currentDayOfWeek = date("N", strtotime($date));
                    if ($currentDayOfWeek != 6 && $currentDayOfWeek != 7) {
                        // Récupération des dates de vacances
                        $planning_query = "SELECT `debut-vacance`, `fin-vacance` FROM planning WHERE nom_medecin='$medecin' AND '$date' BETWEEN `debut-vacance` AND `fin-vacance`";
                        $result_planning = mysqli_query($conn, $planning_query);
                        if ($result_planning && mysqli_num_rows($result_planning) > 0) {
                            echo "La date que vous avez choisie est pendant les vacances du Dr. " . $medecin;
                        } else {
                             
                             $planningData = mysqli_fetch_assoc($result_planning);

                            // Vérification de la date par rapport aux vacances
                            
                                // La plage horaire est disponible et toutes les conditions sont satisfaites
                                $sql_rv = "INSERT INTO rv (nom_patient, nom_medecin, date_rv, heure_rv, telephone) VALUES ('$nom', '$medecin', '$date', '$heure', '$telephone')";
                                if (mysqli_query($conn, $sql_rv)) {
                                    echo "Vous avez pris un rendez-vous avec le Dr. " . $medecin;
                                    header("Location: index2.php");
                                    exit();
                                } else {
                                    echo "Erreur : " . mysqli_error($conn);
                                    exit();
                                }
                        }
                        
                    } else {
                        echo "Veuillez choisir une date autre que le samedi ou le dimanche.";
                    }

                } else {
                    echo "Un rendez-vous existe déjà pour cette heure avec le même médecin.";
                }
            } else {
                echo "Erreur : Aucun médecin correspondant à la spécialité trouvée.";
                exit();
            }
        } else {
            echo "Veuillez choisir une date supérieur ou égal  à la date d'aujourd'hui.";
        }
    } else {
        echo "Un rendez-vous existe déjà pour cette date et cette heure.";
    }
} else {
    echo "Veuillez remplir tous les champs du formulaire.";
}

mysqli_close($conn);

function isAppointmentExist($conn, $date, $heure) {
    $sql_appointment = "SELECT * FROM rv WHERE date_rv='$date' AND heure_rv='$heure'";
    $result_appointment = mysqli_query($conn, $sql_appointment);
    return mysqli_num_rows($result_appointment) > 0;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rendez-vous</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="rendez-vous">
        <h1>Rendez-vous</h1>
        <p>Pour prendre un rendez-vous, veuillez entrer vos informations :</p>
        <form action="rv.php" method="post">
            <div>
                <label for="nom">Votre nom</label>
                <input type="text" id="nom" name="nom" placeholder="Najah" required>
            </div>
            <div>
                <label for="prenom">Votre prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Salma" required>
            </div>
            <div>
                <label for="telephone">Votre téléphone</label>
                <input type="text" id="telephone" name="telephone" placeholder="06 88 68 94 67" required>
            </div>
            <div>
                <label for="date">Entrez la date</label>
                <input type="date" id="date" name="date">
            </div>
            <div>
                <label for="specialite">Spécialité</label>
                <select name="specialite" id="specialite">
                    <option value="cardiologie">Cardiologie</option>
                    <option value="dermatologie">Dermatologie</option>
                    <option value="gynecologie">Gynécologie</option>
                    <option value="ophtalmologie">Ophtalmologie</option>
                    <option value="pneumologie">Pneumologie</option>
                    <option value="neurologie">Neurologie</option>
                    <option value="pediatrie">Pédiatrie</option>
                </select>
            </div>
            <div>
                <label for="heure">Heure</label>
                <select name="heure" id="heure">
                    <option value="08:00:00">08:00:00</option>
                    <option value="09:00:00">09:00:00</option>
                    <option value="10:00:00">10:00:00</option>
                    <option value="11:00:00">11:00:00</option>
                    <option value="14:00:00">14:00:00</option>
                    <option value="15:00:00">15:00:00</option>
                    <option value="16:00:00">16:00:00</option>
                </select>
            </div>
            <div>
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </div>
</body>
</html>











