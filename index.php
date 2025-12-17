<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <title>Document</title>
</head>

<body class="min-h-screen bg-gradient-to-r from-[#0055FF] to-[#002368] flex flex-col">

    <header class="p-2">
        <a href=""><img src="image/Logo.png" alt="" class="h-[150px] relative left-10"></a>
    </header>

    <div class="text-center text-white mb-10">
        <h2 class=" text-3xl font-bold mb-2">Bienvenue A Bankly </h2>
        <p class=" text-lg">Connectez-vous pour accéder à votre espace de
            travail</p>
    </div>

    <div class="flex flex-1 items-center justify-between px-16 relative ">

        <section class="w-[100%] p-8 max-w-[480px] rounded-lg bg-[#012A7D] relative left-10">
            <form action="#" method="">
                <h2 class="text-[#00FFFF] text-center text-3xl font-bold mb-6">LOGIN</h2>

                <div class="mb-4">
                    <label for="email" class="text-[#ffff] block mb-2 font-medium">Adresse email</label>
                    <input type="email" name="email"
                        class="bg-[#ffff] w-full h-10 p-3 border-none outline-none rounded-md"
                        placeholder="Entrez votre email">
                </div>

                <div class="mb-6">
                    <label for="password" class="text-[#ffff] block mb-2 font-medium">Mot de passe</label>
                    <input type="password" id="password" name="password"
                        class="bg-[#ffff] w-full h-10 p-3 border-none outline-none rounded-md"
                        placeholder="Entrez votre mot de passe">
                </div>

                <button type="submit"
                    class="text-white bg-[#0055FF] hover:bg-[#0050ef] transition-colors cursor-pointer w-full h-10 rounded-md mb-4 font-semibold">
                    Se connecter
                </button>

                <p class="text-white text-sm text-center">Pas encore inscrit ? Cliquez sur "<a href=""
                        class="text-[#00FFFF] hover:underline font-bold">SignUp</a>" .</p>
            </form>
        </section>
        <img src="image/image.png" alt="" class="h-[500px] w-[600px] absolute bottom-0 right-0 ">

    </div>

</body>

</html>