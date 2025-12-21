<?php
session_start();
require_once '../config/config.php';

if (isset($_POST['make_transaction'])) {


$id_compte   = $_POST['client'];
$type        = $_POST['type']; 
$montant     = $_POST['solde'];
$description = $_POST['description'];

if ($montant <= 0) {
    header("Location: list_transactions.php?error=montant");
    exit;
}

$q = "SELECT solde FROM compte WHERE id_compte = $id_compte";
$r = mysqli_query($conn, $q);
$data = mysqli_fetch_assoc($r);

$solde_actuel = $data['solde'];

if ($type === 'depot') {
    $solde_apres = $solde_actuel + $montant;
} else {
    $solde_apres = $solde_actuel - $montant;
}

$sql = "INSERT INTO transaction (id_compte, type, montant, solde_apres, description)
VALUES ($id_compte, '$type', $montant, $solde_apres, '$description')";
mysqli_query($conn, $sql);

$update = "UPDATE compte SET solde = $solde_apres WHERE id_compte = $id_compte";
mysqli_query($conn, $update);

header("Location: list_transactions.php?success=1");
exit;

}

?>
