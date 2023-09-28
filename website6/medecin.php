<?php
include("header.html");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>The medecin page</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        /* Ajoutez votre style CSS ici */
        body {
            background: white;
            font-family: Montserrat, "sans-serif";
            justify-content: center;
        }

        .rendez-vous {
            width: 700px;
            border: 1px solid;
            border-radius: 8px;
            padding: 0 50px 0 50px;
            background: white;
        }

        .rendez-vous > h1 {
            font-weight: 500;
        }

        .rendez-vous > p {
            font-weight: 300;
        }

        form div {
            width: 100%;
            display: flex;
            flex-direction: column;
            min-height: 83px;
            margin-top: 25px;
        }

        form div > label {
            margin-bottom: 7px;
            font-weight: 600;
        }

        form div > input,
        form div > select {
            background: #d3cade;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            font-family: Montserrat, "sans-serif";
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.25);
            height: 50px;
            padding-left: 10px;
        }

        form div > input::placeholder {
            color: white;
        }

        form div > select option {
            background: white;
            color: #303030;
        }

        form button {
            width: 450px;
            max-width: 500px;
            height: 60px;
            font-weight: 700;
            font-size: 28px;
            background: white;
            border: rgba(48, 48, 48, 0.5) solid 1px;
            border-radius: 5px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
            color: #303030;
        }
    </style>
</head>

<body>
    <div class="rendez-vous">
        <h1>Page du médecin</h1>
        <p>Entrez vos données</p>
        <form method="POST" action="index1.php">
            <div>
                <label>Nom du médecin:</label>
                <input type="text" name="nom_medecin" placeholder="Fatih" required>
            </div>
            <div>
                <label for="specialite">Spécialité</label>
                <select name="specialite">
                    <option value="cardiologie">Cardiologie</option>
                    <option value="dermatologie">Dermatologie</option>
                    <option value="gynécologie">Gynécologie</option>
                    <option value="ophtalmologie">Ophtalmologie</option>
                    <option value="pneumologie">Pneumologie</option>
                    <option value="neurologie">Neurologie</option>
                    <option value="pédiatrie">Pédiatrie</option>
                </select>
            </div>
            <div>
                <button type="submit" name="submit">Envoyer</button>
            </div>

        </form>
    </div>

</body>

</html>

