<?php
include("header.html");

// Vérification des identifiants d'administration
if(isset($_POST["submit"])){
    $nom_complet = $_POST["nom_complet"];
    $mot_de_passe = $_POST["mot_de_passe"];
    if($nom_complet == "khaoula ait said" && $mot_de_passe == "kkk"){
        header("Location: index.php");
        exit;
    } else {
        echo "Nom complet ou mot de passe incorrect.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>The admin page</title>
    <link rel="stylesheet" href="style3.css">
</head>

<body>
<div class="connexion">
<h1>se connecter</h1>
<p>Entrer votre donnés</p>
<form  method="POST" action="connexion.php" >
<div>
<label>nom complet:</label>
<input type="text" name="nom_complet" placeholder="Najah Salma" required>
</div>
<div>
<label>mot de passe: </label>
<input type="text" name="mot_de_passe"  required>
</div>
<div>
<button type="submit" name="submit">Envoyer</button>
</div>

</form>
</div>

</body>
</html>
