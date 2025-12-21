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

$sql = "SELECT * FROM client WHERE id_client = $id_client";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Client not found");
}

$client = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Client</title>
    <link href="/Bankly-V2-PHP/src/output.css" rel="stylesheet">
</head>
<body>
    <h2>Modifier Client</h2>
    <form action="update_client.php" method="POST">
        <input type="hidden" name="id_client" value="<?php echo $client['id_client']; ?>">

        <label>Prénom</label>
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($client['prenom']); ?>" required>

        <label>Nom</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($client['email']); ?>">

        <label>CIN</label>
        <input type="text" name="CIN" value="<?php echo htmlspecialchars($client['CIN']); ?>" required>

        <label>Téléphone</label>
        <input type="text" name="telephone" value="<?php echo htmlspecialchars($client['telephone']); ?>">

        <label>Adresse</label>
        <input type="text" name="adresse" value="<?php echo htmlspecialchars($client['adresse']); ?>">

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
