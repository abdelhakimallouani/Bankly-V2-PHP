<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_account'])) {
    $id_compte = intval($_POST['id_compte']);
    $id_client = intval($_POST['id_client']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $solde = $_POST['solde'];
    $statut = mysqli_real_escape_string($conn, $_POST['statut']);

    if (empty($id_client) || empty($type) || empty($statut)) {
        header("Location: list_accounts.php");
        exit;
    }

    if ($solde < 0) {
        header("Location: list_accounts.php");
        exit;
    }

    if (!in_array($type, ['courant', 'epargne'])) {
        header("Location: list_accounts.php");
        exit;
    }

    if (!in_array($statut, ['actif', 'bloque'])) {
        header("Location: list_accounts.php");
        exit;
    }

    $check_client = "SELECT id_client FROM client WHERE id_client = $id_client";
    $client_result = mysqli_query($conn, $check_client);

    if (mysqli_num_rows($client_result) == 0) {
        header("Location: list_accounts.php");
        exit;
    }

    $sql = "UPDATE compte SET 
            id_client = $id_client,
            type = '$type',
            solde = $solde,
            statut = '$statut'
            WHERE id_compte = $id_compte";

    if (mysqli_query($conn, $sql)) {
        header("Location: list_accounts.php");
        exit;
    } else {
        die("Erreur" . mysqli_error($conn));
        exit;
    }
} else {
    header("Location: list_accounts.php");
    exit;
}
