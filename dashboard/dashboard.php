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
        <a href="../dashboard/dashboard.php" class="flex items-center space-x-3 text-[#E0E0E0] hover:bg-[#ffffff3d] bg-[#ffffff3b] rounded-lg p-3 mb-2 cursor-pointer">
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
        <div class="flex items-center space-x-3 mb-2">
            <div class="text-[#E0E0E0] hover:bg-[#ffffff3d] rounded-lg">
                <h4 class="font-bold text-[#E0E0E0]"><?php echo htmlspecialchars($_SESSION['nom_complet']); ?></h4>
                <p class="text-sm text-[#E0E0E0]"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
            </div>
        </div>
        <div class="border-t border-gray-200 pt-2">
            <a href="../auth/logout.php" class="flex items-center space-x-3 text-[#E0E0E0] hover:bg-[#ff000051] hover:text-[#FF0000] rounded-lg p-2 cursor-pointer ">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Déconnexion</span>
    
            </a>
        </div>
    </div>
</section>

<section class="ml-70 p-8 bg-[#F9FAFB]">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#0F1729] mb-2">
            Bonjour, <?php echo htmlspecialchars($_SESSION['nom_complet']); ?> 👋
        </h1>
        <p class="text-gray-600">Voici un aperçu de l'activité de la banque aujourd'hui</p>
    </div>

    <div class="grid grid-cols-4 gap-6 mb-8">
        <div class= "flex items-center justify-center flex-col bg-white rounded-xl shadow-sm border border-gray-200 p-6 cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-[#65758b2c] rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-[#65758B] text-xl"></i>
                </div>
            </div>
            <p class="text-[#65758B] text-sm mb-1">Total Clients</p>
            <h1 class="text-2xl font-bold text-[#0F1729] mb-1">3</h1>
            <p class="text-[#65758B] text-sm">Clients enregistrés</p>
        </div>

        <div class="flex items-center justify-center flex-col bg-white rounded-xl shadow-sm border border-gray-200 p-6 cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-[#0447cc31] rounded-lg flex items-center justify-center">
                    <i class="fas fa-credit-card text-[#0447cc] text-xl"></i>
                </div>
            </div>
            <p class="text-[#65758B] text-sm mb-1">Total Comptes</p>
            <h1 class="text-2xl font-bold text-[#0F1729] mb-1">5</h1>
            <p class="text-[#65758B] text-sm">Comptes actifs</p>
        </div>

        <div class="flex items-center justify-center flex-col bg-white rounded-xl shadow-sm border border-gray-200 p-6 cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-[#13b9042e] rounded-lg flex items-center justify-center">
                    <i class="fas fa-wallet text-[#13b904] text-xl"></i>
                </div>
            </div>
            <p class="text-[#65758B] text-sm mb-1">Solde Total</p>
            <h1 class="text-2xl font-bold text-[#0F1729] mb-1">333,44 DH</h1>
            <p class="text-[#65758B] text-sm">Tous les comptes</p>
        </div>

        <div class="flex items-center justify-center flex-col bg-white rounded-xl shadow-sm border border-gray-200 p-6 cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-[#ffe4be94] rounded-lg flex items-center justify-center">
                    <i class="fas fa-exchange-alt text-orange-600 text-xl"></i>
                </div>
            </div>
            <p class="text-[#65758B] text-sm mb-1">Transactions du jour</p>
            <h1 class="text-2xl font-bold text-[#0F1729] mb-1">5</h1>
            <div class="flex items-center justify-center flex-col text-sm">
                <span class="text-green-500 ">138.456,00 DH dépôts</span>
                <span class="text-red-500">2.000,00 DH retraits</span>
            </div>
        </div>
    </div>
    <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[#0F1729]">Transactions récentes</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-[#D9D9DA] mb-8">
        <div >
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#D9D9DA] ">
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Type</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Compte</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Montant</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Description</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-[#D9D9DA]">
                        <td class="py-4 px-4 inline-flex items-center px-3 py-1 rounded-full text-[#13DD00]">Depot</td>
                        <td class="py-3 px-3 text-gray-700 ">BNK-2025-001</td>
                        <td class="py-3 px-3 text-[#13DD00] ">+500,00 DH</td>
                        <td class="py-3 px-3 text-gray-600">virement salaire</td>
                        <td class="py-3 px-3 text-[#65758B]">07 dec.2025, 17:46</td>
                    </tr>
                    <tr class="border-b border-[#D9D9DA]">
                        <td class="py-4 px-4 inline-flex items-center px-3 py-1 rounded-full text-[#FF0000] ">Retrait</td>
                        <td class="py-4 px-4 text-gray-700 ">BNK-2025-001</td>
                        <td class="py-4 px-4 text-[#FF0000]">-100,00 DH</td>
                        <td class="py-4 px-4 text-gray-600">Retrait de jour</td>
                        <td class="py-4 px-4 text-[#65758B]">07 dec.2025, 17:46</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-[#0F1729]">Derniers clients</h2>
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-semibold text-[#0F1729]">Youness Arroubi</h4>
                        <p class="text-[#65758B] text-sm">younessarroubi@gmail.com</p>
                    </div>
                    <p class="text-[#65758B] text-sm">15/01/2024</p>
                </div>
                
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-[#0F1729] mb-6">Activité rapide</h2>
            
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <p class="text-gray-600">Dépôts aujourd'hui</p>
                        <p class="text-[#13DD00]">+345,00 DH</p>
                    </div>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <p class="text-gray-600">Retraits aujourd'hui</p>
                        <p class="text-[#FF0000]">-0,00 DH</p>
                    </div>
                </div>
                
                <div class="border-t border-gray-200"></div>
                
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-600 font-medium">Balance nette</p>
                    </div>
                    <p class="text-[#13DD00]">345,00 DH</p>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>