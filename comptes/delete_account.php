<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: list_accounts.php?error=empty");
    exit;
}

$id_compte = intval($_GET['id']);

$delete_transactions = "DELETE FROM transaction WHERE id_compte = $id_compte";
mysqli_query($conn, $delete_transactions);

$sql = "DELETE FROM compte WHERE id_compte = $id_compte";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: list_accounts.php?success=deleted");
    exit;
} else {
    die("Erreur suppression compte : " . mysqli_error($conn));
}
