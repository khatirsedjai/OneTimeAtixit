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
                <div class="flex justify-between mb-8 items-start">
                    <div class="flex flex-col">
                        <label for="message" class="text-lg font-semibold-generer-lien"><u>Votre lien généré :</u>
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

    <script>
        function copyLink() {
            var copyText = document.getElementById("generated-link");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
        }
    </script>
    </body>

@endsection
