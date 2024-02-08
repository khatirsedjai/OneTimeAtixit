@extends('template')
@section('content')

    <body class="h-full">
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
                <form method="post" action="{{ route('generateLink') }}">
                    @csrf
                    <label for="message" class="label_t text-lg font-semibold mb-2"> Saisir votre message : </label>
                    <br>
                    <textarea id="message" name="message" class="message-input-generer-lien w-full rounded" placeholder="Entrez votre message ici..." required></textarea>
                    <button type="submit" class="submit-button-generer-lien bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Valider</button>
                </form>

                <form id="passwordForm" class="flex justify-between items-center mt-7">
                    <div class="flex items-center">
                    <label for="message" class="label_t text-lg font-semibold mb-2"> Générer un Mot de Passe aléatoire :
                        <input type="text" id="generatedPassword" class="message-input-generer-mdp mb-4 rounded w-full mt-14px-2" placeholder="Mot de passe généré" readonly>
                        <button type="button" id="generatePasswordBtn" class="submit-button-generer-lien bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Générer</button>
                    </label>
                    </div>
                </form>



            </div>
        </div>
    </div>

    <script>
        document.getElementById('generatePasswordBtn').addEventListener('click', function() {
            fetch('https://www.dinopass.com/password/simple')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('generatedPassword').value = data.trim();
                })
                .catch(error => console.error('Erreur lors de la récupération du mot de passe :', error));
        });
    </script>
    </body>

@endsection

