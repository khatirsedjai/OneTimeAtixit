@extends('template')
@section('content')

    <body class="h-full">
    <div class="min-h-full flex flex-col items-center justify-center">
        <div class="max-w-4xl w-full">
            <div class="message-container p-4 relative">
                <h2 class="text-3xl font-semibold mb-2">Votre message :</h2>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded absolute top-0 right-0 mt-2" onclick="copyMessage()">Copier le message</button>
                <div class="message-container p-4 relative bg-gray-200 rounded shadow-md">
                <p id="message">{{ $message->content }}</p>
                </div>
            </div>
            <div class="message-container p-4 relative">
                <h2 class="text-2xl font-semibold mb-2">Rappel</h2>
                <ul class="list-disc pl-6 text-sm text-gray-600">
                    <li>Vous ne pouvez plus récupérer cette note. Cette note a été supprimée et détruite du système.</li>
                    <li>Copiez le contenu dans un emplacement sécurisé sur votre ordinateur avant de fermer cette page.</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        function copyMessage() {
            var messageText = document.getElementById("message").innerText;
            var input = document.createElement('input');
            input.setAttribute('value', messageText);
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
        }
    </script>
    </body>

@endsection

