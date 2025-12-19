<?php
session_start();
require_once '../config/config.php';

if (isset($_POST['signup'])) {

    $nom_complet = mysqli_real_escape_string($conn, $_POST['nom_complet']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (empty($_POST['nom_complet']) || empty($_POST['email']) || empty($_POST['password'])) {
        header("Location: signup.php?error");
        exit;
    }

    $check = "SELECT id_user FROM utilisateur WHERE email = '$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        header("Location: signup.php?error");
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateur (nom_complet, email, password)
            VALUES ('$nom_complet', '$email', '$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php?");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>