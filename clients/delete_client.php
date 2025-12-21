<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: list_clients.php");
    exit;
}

$id_client = intval($_GET['id']);

$accounts = mysqli_query($conn, "SELECT id_compte FROM compte WHERE id_client = $id_client");

while ($acc = mysqli_fetch_assoc($accounts)) {
    $id_compte = $acc['id_compte'];
    mysqli_query($conn, "DELETE FROM transaction WHERE id_compte = $id_compte");
}

mysqli_query($conn, "DELETE FROM compte WHERE id_client = $id_client");

mysqli_query($conn, "DELETE FROM client WHERE id_client = $id_client");

header("Location: list_clients.php?success=deleted");
exit;

?>

