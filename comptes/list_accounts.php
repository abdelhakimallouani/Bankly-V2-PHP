<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$sql = "SELECT compte.id_compte, compte.type, compte.solde, compte.statut, compte.create_date, client.nom, client.prenom, client.CIN
FROM compte
JOIN client ON compte.id_client = client.id_client
ORDER BY compte.create_date DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("query failed : " . mysqli_error($conn));
}
?>

<?php
$clients_sql = "SELECT id_client, nom, prenom, CIN FROM client ORDER BY nom ASC";
$clients_result = mysqli_query($conn, $clients_sql);

if (!$clients_result) {
    die("Erreur clients: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Bankly-V2-PHP/src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Bankly-V2</title>
</head>

<body class="bg-gray-50 min-h-screen">

    <section class="fixed left-0 top-0 h-full w-70 bg-[#012A7D] border-r border-gray-200 shadow-sm p-6 flex flex-col">
        <div class="mb-10">
            <img src="../image/Logo.png" alt="" class="h-10">
        </div>

        <div class="flex-1">
            <a href="../dashboard/dashboard.php" class="flex items-center space-x-3 text-[#E0E0E0] hover:bg-[#ffffff3d] focus:bg-[#ffffff3b] rounded-lg p-3 mb-2 cursor-pointer">
                <i class="fas fa-chart-bar"></i>
                <span>Tableau de bord</span>
            </a>
            <a href="../clients/list_clients.php" class="flex items-center space-x-3 text-[#E0E0E0] hover:bg-[#ffffff3d] focus:bg-[#ffffff3d] rounded-lg p-3 mb-2 cursor-pointer">
                <i class="fas fa-users"></i>
                <span>Clients</span>
            </a>
            <a href="../comptes/list_accounts.php" class="flex items-center space-x-3 text-[#E0E0E0] hover:bg-[#ffffff3d] focus:bg-[#ffffff3d] rounded-lg p-3 mb-2 cursor-pointer">
                <i class="fas fa-credit-card"></i>
                <span>Comptes</span>
            </a>
            <a href="../transactions/list_transactions.php" class="flex items-center space-x-3 text-[#E0E0E0] hover:bg-[#ffffff3d] focus:bg-[#ffffff3d] rounded-lg p-3 mb-2 cursor-pointer">
                <i class="fas fa-exchange-alt"></i>
                <span>Transactions</span>
            </a>
        </div>

        <div class="border-t border-gray-200 pt-2">
            <div class="flex items-center space-x-3 mb-2 ">
                <div class="text-[#E0E0E0] hover:bg-[#ffffff3d] rounded-lg cursor-pointer w-full p-2 ">
                    <h4 class="font-bold text-[#E0E0E0]"><?php echo htmlspecialchars($_SESSION['nom_complet']); ?></h4>
                    <p class="text-sm text-[#E0E0E0]"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
                </div>
            </div>
            <div class="border-t border-gray-200 pt-2">
                <a href="../auth/logout.php" class="flex items-center space-x-3 text-[#E0E0E0] hover:bg-[#ff000051] hover:text-[#FF0000] rounded-lg p-2 cursor-pointer">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <span>Deconnexion</span>

                </a>
            </div>
        </div>
    </section>

    <section class="ml-70 p-8 bg-[#F9FAFB]">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-[#0F1729] mb-3">Comptes</h2>
                <p class="text-[#65758B]">Gerez les comptes bancaires de vos clients</p>
            </div>
            <button onclick="openModal()" class="bg-[#0F1729] hover:bg-[#0f1729df] text-white font-medium py-3 px-5 rounded-lg flex items-center space-x-2 cursor-pointer">
                <i class="fas fa-plus"></i>
                <span>Nouveau compte</span></button>
        </div>
        <div class="mb-8">
            <div class="relative ">
                <input type="text"
                    placeholder="Rechercher par numero ou client..."
                    class="w-full pl-12 pr-3 py-2 border border-[#D9D9DA] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#012a7d75] ">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-[#65758B]"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-[#D9D9DA] mb-8">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#D9D9DA]">
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Numero de compte</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Client</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Type</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Solde</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Statut</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Date creation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="border-b border-[#D9D9DA]">

                                <td class="py-4 px-4 text-[#0F1729] font-medium">
                                    <?php echo "BNK-" . $row['id_compte']; ?>
                                </td>

                                <td class="py-3 px-4 text-[#65758B]">
                                    <?php echo htmlspecialchars($row['nom'] . " " . $row['prenom']); ?>
                                </td>

                                <td class="py-3 px-4 text-[#65758B] capitalize">
                                    <?php echo htmlspecialchars($row['type']); ?>
                                </td>

                                <td class="py-3 px-4 text-[#65758B]">
                                    <?php echo $row['solde'] . " DH"; ?>
                                </td>

                                <td class="py-3 px-4">
                                    <?php if ($row['statut'] === 'actif'): ?>
                                        <span class="text-[#13DD00] ">
                                            Actif
                                        </span>
                                    <?php else: ?>
                                        <span class="text-[#FF0000]">
                                            Bloque
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4 text-[#65758B]">
                                    <?php echo date('d/m/Y', strtotime($row['create_date'])); ?>
                                </td>

                                <td class="py-3">
                                    <div class="flex items-center space-x-4">

                                        <a href="" class="text-[#65758B] cursor-pointer">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <a href="" class="text-[#FF0000] cursor-pointer">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        <?php endwhile; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-6 text-[#65758B] ">
                                Aucun Comptes trouve
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

        <!-- modal ajouter account  -->
        <div id="clientModal"
            class="fixed inset-0 bg-black/40 hidden flex items-center justify-center z-50">

            <div class="bg-white w-full max-w-xl rounded-xl shadow-lg p-8 relative">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Nouveau compte</h2>
                    <button onclick="closeModal()" class="text-[#65758B] text-2xl cursor-pointer">X</button>
                </div>

                <form action="add_account.php" method="POST" class="space-y-4">

                    <div>

                        <label class="text-[#65758B]">Client</label>

                        <select name="client" required
                            class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg py-2 focus:outline-none">
                            <option value="">Selectionner un client</option>
                            <?php while ($client = mysqli_fetch_assoc($clients_result)): ?>
                                <option value="<?php echo $client['id_client']; ?>">
                                    <?php echo htmlspecialchars($client['nom'] . " " . $client['prenom'] . " (" . $client['CIN'] . ")"); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                    </div>

                    <div>
                        <label class=" text-[#65758B]">Type de compte</label>
                        <select name="type" id="" class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none  ">
                            <option value="" class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none ">Selectionner un type</option>
                            <option value="courant" class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none ">courant</option>
                            <option value="epargne" class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none ">epargne</option>
                        </select>
                    </div>

                    <div>
                        <label class=" text-[#65758B]">Solde initial (DH)</label>
                        <input type="number" name="solde" required
                            class="w-full border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#012a7d75]">


                    </div>

                    <div>
                        <label class=" text-[#65758B]">Statut</label>
                        <select name="statut" id="" class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none  ">
                            <option value="" class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none ">Selectionner un type</option>
                            <option value="actif" class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none ">actif</option>
                            <option value="bloque" class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none ">bloque</option>
                        </select>

                    </div>

                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" onclick="closeModal()"
                            class="px-6 py-2 border border-[#D9D9DA] rounded-lg text-[#65758B] hover:bg-gray-100 cursor-pointer">
                            Annuler
                        </button>

                        <button type="submit" name="add_account"
                            class=" px-6 py-2 bg-[#0F1729] text-white rounded-lg hover:bg-[#0f1729df] cursor-pointer">
                            Creer
                        </button>
                    </div>
                </form>
            </div>
        </div>



    </section>
    <script>
        function openModal() {
            document.getElementById('clientModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('clientModal').classList.add('hidden');
        }
    </script>

</body>

</html>