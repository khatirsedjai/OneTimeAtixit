<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OneTimeAtixit</title>

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="Favicon Atixit.png">
    <link href="https://fonts.googleapis.com/css2?family=Alata:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">

    <style>

        html, body, .min-h-full, .bg-gray-800 {
            width: 100%;
        }

        body {
            font-family: 'Raleway', sans-serif;
            font-size: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Occupe au moins toute la hauteur de la fenêtre */
        }


        h1, h2, h3, h4, h5, h6 {
            font-family: 'Alata', sans-serif;
            font-size: 25%;
        }

        label_t{
            font-family: 'Alata', sans-serif;
            font-size: 25%;
        }

        .footer {
            background: linear-gradient(to right, #52b4e6, #AB6FAE);
            color: white;
            text-align: center;
            padding: 1% 2%;
            font-size: 16px;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            z-index: 999; /* Assure que le footer est au-dessus du contenu */
        }


        nav {
            width: 100%;
        }

        .head {
            background: linear-gradient(to right, #52b4e6, #AB6FAE);
        }

        /* Style spécifique au logo */
        .head img {
            margin-top: 10px; /* Ajustement du logo */
            margin-bottom: 10px; /* Ajustement du logo */
        }

        .form-container-generer-lien {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            margin-bottom: 60px; /* Ajout de marge en bas */
        }

        .message-input-generer-lien {
            width: 100%;
            height: 150px; /* La taille du champs */
            padding: 10px;
            margin-bottom: 10px;
            resize: none;
        }

        .message-input-generer-mdp {
            width: 100%;
            height: 50%; /* La taille du champs */
            padding: 10px;
            margin-bottom: 10px;
            resize: none;
        }

        .submit-button-generer-lien {
            display: block;
            margin-left: auto;
            padding: 10px 20px;
            background-color: #1a202c; /* Couleur de fond grise */
            color: Black; /* Texte blanc */
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button-generer-lien:hover {
            background-color: #718096; /* Nouvelle couleur bleue au survol */
        }
    </style>



    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen">

<div class="min-h-full">
    <nav class="head bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <img class="h-25 w-40" src="{{ asset('AtixitOneTime.png') }}" alt="Your Company">
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-white shadow flex items-center">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">One Time Atixit</h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

    <div class="min-h-full flex flex-col items-center justify-center">
        <div class="max-w-4xl w-full">
            <div class="form-container-generer-lien">
                <div class="flex justify-between mb-8 items-start">
                    <div class="w-full pr-10">
                        <h2 class="text-lg font-semibold mb-2">Description</h2>
                        <p class="text-sm text-gray-600">Si vous devez envoyer un mot de passe ou toute autre forme d'informations simples mais sensibles à quelqu'un, vous ne pouvez pas l'envoyer par messagerie instantanée ou par courrier électronique. Ces méthodes ne sont pas sécurisées car toute personne ayant peu de connaissances peut intercepter ces informations lors de leur transmission. En utilisant OneTimeAtixit comme « intermédiaire », vous pouvez transférer ces données en toute sécurité à votre destinataire.</p>
                    </div>
                </div>
                <div class="flex justify-between mb-8 items-start">
                    <div class="w-full pr-10">
                        <h2 class="text-lg font-semibold mb-2">Étapes</h2>
                        <ol class="list-decimal text-sm text-gray-600 list-inside">
                            <li class="mb-2">Saisir votre texte</li>
                            <li class="mb-2">Générer votre lien</li>
                            <li>Partager avec qui vous voulez en toute sécurité</li>
                        </ol>
                    </div>
                </div>
                <div class="flex justify-between mb-8 items-start">
                    <div class="flex flex-col">
                        <label for="message" class="label_t text-lg font-semibold-generer-lien"><u>Votre lien généré :</u>
                        <br>
                        <input type="text" id="generated-link" value="{{ url('/link/' . $token) }}" readonly>
                        </label>
                        <div class="flex mt-2">
                            <div class="flex mt-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" onclick="copyLink()">Copier le lien</button>
                                <form method="POST" action="{{ route('regenerateLink') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Régénérer un lien</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        </div>
    </main>
</div>


<footer class="footer">
    Copyright © 2024 Atixit – SAS au capital de 7 000 € – 828 174 169 R.C.S. CRETEIL – Code APE 6202A
</footer>

    <script>
        function copyLink() {
            var copyText = document.getElementById("generated-link");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
        }
    </script>


</body>
</html>
