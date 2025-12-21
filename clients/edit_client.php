<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_POST['update_client'])) {
    $id_client = intval($_POST['id_client']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $CIN = mysqli_real_escape_string($conn, $_POST['CIN']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);

    $sql = "UPDATE client SET 
            prenom = '$prenom',
            nom = '$nom',
            email = '$email',
            CIN = '$CIN',
            telephone = '$telephone',
            adresse = '$adresse'
            WHERE id_client = $id_client";

    if (mysqli_query($conn, $sql)) {
        header("Location: list_clients.php");
        exit;
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
} else {
    header("Location: list_clients.php");
    exit;
}
?>