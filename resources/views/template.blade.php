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
                    <a href="{{ route('create') }}"> <img class="h-25 w-40" src="{{ asset('AtixitOneTime.png') }}" alt="Your Company"> </a>
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
            @yield('content')
        </div>
    </main>
</div>


<footer class="footer">
    Copyright © 2024 Atixit – SAS au capital de 7 000 € – 828 174 169 R.C.S. CRETEIL – Code APE 6202A – <a href="https://atixit.fr/" class="text-white">Voir notre site</a>
</footer>

</body>
</html>

