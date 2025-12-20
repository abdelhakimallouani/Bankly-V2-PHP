<?php

include("../config/config.php");

if (isset($_POST['add_client'])) {

    $nom       = $_POST['nom'];
    $prenom    = $_POST['prenom'];
    $CIN       = $_POST['CIN'];
    $email     = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse   = $_POST['adresse'];

    if (empty($nom) || empty($prenom) || empty($CIN)) {
        header("Location: list_clients.php?error=empty");
        exit;
    }

    $query = "INSERT INTO client (nom, prenom, CIN, email, telephone, adresse)
              VALUES ('$nom', '$prenom', '$CIN', '$email', '$telephone', '$adresse')";

    if (mysqli_query($conn, $query)) {
        header("Location: list_clients.php?success=1");
        exit;
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
}
?>
