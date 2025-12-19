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
            <div class="flex items-center space-x-3 mb-2">
                <div class="text-[#E0E0E0] hover:bg-[#ffffff3d] rounded-lg">
                    <h4 class="font-bold text-[#E0E0E0]"><?php echo htmlspecialchars($_SESSION['nom_complet']); ?></h4>
                    <p class="text-sm text-[#E0E0E0]"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
                </div>
            </div>
            <div class="border-t border-gray-200 pt-2">
                <a href="../auth/logout.php" class="flex items-center space-x-3 text-[#E0E0E0] hover:bg-[#ff000051] hover:text-[#FF0000] rounded-lg p-2 cursor-pointer">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <span>Déconnexion</span>

                </a>
            </div>
        </div>
    </section>

    <section class="ml-70 p-8 bg-[#F9FAFB]">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-[#0F1729] mb-3">Clients</h2>
                <p class="text-[#65758B]">Gérez les informations de vos clients</p>
            </div>
            <button class="bg-[#0F1729] hover:bg-[#0f1729df] text-white font-medium py-3 px-5 rounded-lg flex items-center space-x-2 cursor-pointer">
                <i class="fas fa-plus"></i>
                <span>Nouveau client</span></button>
        </div>
         <div class="mb-8">
            <div class="relative ">
                <input type="text" 
                       placeholder="Rechercher par nom, email ou CIN..." 
                       class="w-full pl-12 pr-3 py-2 border border-[#D9D9DA] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#012a7d75] focus:border-transparent text-[#0F1729]">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-[#65758B]"></i>
            </div>
        </div>
        <div  class="bg-white rounded-xl shadow-sm border border-[#D9D9DA] mb-8">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#D9D9DA]">
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Client</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">CIN</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Téléphone</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Comptes</th>
                        <th class="text-left py-3 px-4 text-[#65758B] font-medium">Date création</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-[#D9D9DA]">
                        <td class="py-4 px-4 inline-flex items-center px-3 py-1 rounded-full">
                            <div>
                                <p class=" text-[#0F1729]">youness arroubi</p>
                                <p class=" text-[#65758B]">younessarroubi@gmail.com</p>
                            </div>
                        </td>
                        <td class=" text-left py-3 px-3 text-[#65758B] ">AB00001</td>
                        <td class="text-left py-3 px-3 text-[#0055FF]">0 Comptes</td>
                        <td class="text-left py-3 px-3 text-[#65758B]">virement salaire</td>
                        <td class="text-left py-3 px-3 text-[#65758B]">15/01/2025</td>
                        <td class="py-4 ">
                                <div class="flex items-center space-x-5">
                                    <button class="text-[#0F1729] cursor-pointer">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button class="text-[#65758B] cursor-pointer">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                    <button class="text-[#FF0000] ursor-pointer">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </section>

</body>

</html>