@extends('template')
@section('content')

    <body class="h-full">
    <div class="min-h-full">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="message-container">
                <h2 class="text-xl font-semibold mb-2">Ce message va s'autodétruire !</h2>
                <p class="text-sm text-gray-600 mb-4">Une fois consultée, vous ne pourrez plus visualiser cette note. Si vous avez besoin d'accéder à nouveau à ces informations, veuillez les copier dans un emplacement sécurisé.</p>

                <form action="/validate/{{ $token }}" method="post">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Valider le lien</button>
                </form>
            </div>
        </div>
    </div>
    </body>

@endsection
