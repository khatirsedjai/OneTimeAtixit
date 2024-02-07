@extends('template')
@section('content')

    <div class="flex flex-col items-center justify-center min-4-screen">
        <br><br><br><br>
        <h1 class="text-3xl font-semibold mb-4">Désolé, cette page n'est plus disponible.</h1>
        <p class="text-gray-600 mb-8">La page que vous recherchez n'est plus disponible ou a été supprimée.</p>
        <a href="{{ route('create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Retour à la page d'accueil</a>
    </div>

@endsection
