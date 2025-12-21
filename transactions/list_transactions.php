<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$sql = "SELECT  t.id_transaction, t.type AS type_transaction, t.montant, t.solde_apres, t.description, t.create_date, c.id_compte, cl.nom, cl.prenom
FROM transaction t
JOIN compte c ON t.id_compte = c.id_compte
JOIN client cl ON c.id_client = cl.id_client
ORDER BY t.create_date DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("query failed : " . mysqli_error($conn));
}
?>


<?php
$accounts_sql = "SELECT compte.id_compte, client.nom, client.prenom
FROM compte
JOIN client ON compte.id_client = client.id_client
ORDER BY compte.id_compte ASC";
$accounts_result = mysqli_query($conn, $accounts_sql);


if (!$accounts_result) {
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
                <h2 class="text-3xl font-bold text-[#0F1729] mb-3">Transactions</h2>
                <p class="text-[#65758B]">Historique des depôts et retraits</p>
            </div>
            <button onclick="openModal()" class="bg-[#0F1729] hover:bg-[#0f1729df] text-white font-medium py-3 px-5 rounded-lg flex items-center space-x-2 cursor-pointer">
                <i class="fas fa-plus"></i>
                <span>Nouveau transaction</span></button>
        </div>
        <div class="mb-8">
            <div class="relative ">
                <input type="text"
                    placeholder="Rechercher ..."
                    class="w-full pl-12 pr-3 py-2 border border-[#D9D9DA] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#012a7d75] ">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-[#65758B]"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-[#D9D9DA] mb-8">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#D9D9DA]">
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Type</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Compte</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Montant</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Solde apres</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Description</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Date creation</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Agent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="border-b border-[#D9D9DA]">

                                <td class="py-3 px-4 font-medium">
                                    <?php if ($row['type_transaction'] === 'depot'): ?>
                                        <span class="text-[#13DD00]">Depot</span>
                                    <?php else: ?>
                                        <span class="text-[#FF0000]">Retrait</span>
                                    <?php endif; ?>
                                </td>

                                <td class="py-3 px-4">
                                    <span class="text-[#0F1729]"><?= "BNK-" . $row['id_compte'] ?></span><br>
                                    <span class="text-[#65758B]"><?= htmlspecialchars($row['nom'] . " " . $row['prenom']) ?></span>
                                </td>

                                <td class="py-3 px-4">
                                    <?php if ($row['type_transaction'] === 'depot'): ?>
                                        <span class="text-[#13DD00]">
                                            +<?= $row['montant'] ?> DH
                                        </span>
                                    <?php else: ?>
                                        <span class="text-[#FF0000]">
                                            -<?= $row['montant'] ?> DH
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="py-3 px-4 text-[#65758B]">
                                    <?= $row['solde_apres'] ?> DH
                                </td>

                                <td class="py-3 px-4 text-[#65758B]">
                                    <?= htmlspecialchars($row['description']) ?>
                                </td>

                                <td class="py-3 px-4 text-[#65758B]">
                                    <?= date('d/m/Y H:i', strtotime($row['create_date'])) ?>
                                </td>

                                <td class="py-3 px-4 text-[#65758B]">
                                    <?= htmlspecialchars($_SESSION['nom_complet']) ?>
                                </td>

                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-6 text-[#65758B]">
                                Aucune transaction trouve
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>


            </table>
        </div>

        <!-- modal ajouter transaction  -->
        <div id="clientModal"
            class="fixed inset-0 bg-black/40 hidden flex items-center justify-center z-50">

            <div class="bg-white w-full max-w-xl rounded-xl shadow-lg p-8 relative">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Nouveau compte</h2>
                    <button onclick="closeModal()" class="text-[#65758B] text-2xl cursor-pointer">X</button>
                </div>

                <form action="make_transaction.php" method="POST" class="space-y-4">

                    <div>

                        <label class="text-[#65758B]">Client</label>

                        <select name="client" required
                            class="w-full text-[#65758B] border border-[#D9D9DA] rounded-lg py-2 focus:outline-none">

                            <option value="">Selectionner un compte</option>

                            <?php while ($acc = mysqli_fetch_assoc($accounts_result)): ?>
                                <option value="<?= $acc['id_compte'] ?>">
                                    <?= "BNK-" . $acc['id_compte'] . " - " . $acc['nom'] . " " . $acc['prenom'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                    </div>

                    <label class="text-[#65758B]">Type d'operation</label>
                    <div class="grid grid-cols-2 gap-4">

                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="depot" required hidden>
                            <div class="border rounded-lg px-4 py-2 text-center text-[#13DD00] hover:bg-[#13DD00] hover:text-white focus:bg-[#13DD00] focus:text-white">
                                Depot
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="retrait" required hidden>
                            <div class="border rounded-lg px-4 py-2 text-center text-[#FF0000] hover:bg-[#FF0000] hover:text-white focus:bg-[#FF0000] focus:text-white">
                                Retrait
                            </div>
                        </label>

                    </div>

                    <div>
                        <label class=" text-[#65758B]">Montant (DH)</label>
                        <input type="number" name="solde" required
                            class="w-full border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#012a7d75]">

                    </div>

                    <div>
                        <label class=" text-[#65758B]">Description</label>
                        <textarea name="description" id="" class="w-full border border-[#D9D9DA] rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#012a7d75]">
                        </textarea>

                    </div>

                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" onclick="closeModal()"
                            class="px-6 py-2 border border-[#D9D9DA] rounded-lg text-[#65758B] hover:bg-gray-100 cursor-pointer">
                            Annuler
                        </button>

                        <button type="submit" name="make_transaction"
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