<?php
session_start();
include("../config/config.php");

if (isset($_POST['add_account'])) {

    $id_client = $_POST['client'];
    $type      = $_POST['type'];
    $solde     = $_POST['solde'];
    $statut    = $_POST['statut'];

    if (empty($id_client) || empty($type) || empty($solde) || empty($statut)) {
        header("Location: list_accounts.php?error=empty");
        exit;
    }

    $query = "INSERT INTO compte (id_client, type, solde, statut)
              VALUES ('$id_client', '$type', '$solde', '$statut')";

    if (mysqli_query($conn, $query)) {
        header("Location: list_accounts.php?success=1");
        exit;
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
}
?>
