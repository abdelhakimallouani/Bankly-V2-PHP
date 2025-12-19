<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link href="/Bankly-V2-PHP/src/output.css" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body >

<section>
    <img src="" alt="">
    <div>
        <a href="">Tableau de bord</a>
        <a href="">Clients</a>
        <a href="">Transactions</a>
    </div>

    <div>
        <h4><?php echo htmlspecialchars($_SESSION['nom_complet']); ?></h4>
        <p><?php echo htmlspecialchars($_SESSION['email']); ?> </p>
    </div>
     <a href="../auth/logout.php"
           class=" bg-red-500 text-white0">
            Logout
        </a>
</section>
<section>

    <div>
        <h1 class="text-2xl font-bold mb-4">
            Welcome, <?php echo htmlspecialchars($_SESSION['nom_complet']); ?> 
        </h1>
        <p>Voici un aperçu de l'activité de la banque aujourd'hui</p>
    </div>

    <div>
        <div>
            <i></i>
            <p>Total Clients</p>
            <h1></h1>
            <p>Clients enregistrés</p>
        </div>
        <div>
            <i></i>
            <p>Total Comptes</p>
            <h1></h1>
            <p>CComptes actifs</p>
        </div>
        <div>
            <i></i>
            <p>Solde Total</p>
            <h1></h1>
            <p>Tous les comptes</p>
        </div>
        <div>
            <i></i>
            <p>Transactions du jour</p>
            <h1></h1>
            <p>DH dépôts</p>
            <p>DH retraits</p>
        </div>
    </div>

    <div>
        <h2>Transactions récentes</h2>

        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Compte</th>
                    <th>Montant</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Depot</td>
                    <td>BNK-2025-001</td>
                    <td>+500,00 DH</td>
                    <td>vairement salaire</td>
                    <td>07 dec.2025, 17:46</td>
                </tr>
            </tbody>

        </table>
    </div>
</section>

</div>

</body>
</html>
