<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Message;


class MessageController extends Controller
{
    public function create()
    {
        // Vérifier et supprimer le token stocké en session
        $this->checkAndDeleteToken();

        return view('create');
    }

    public function generateLink(Request $request)
    {
        // Nettoyer les messages et les tokens générés en cas de rafraîchissement
        $this->cleanGeneratedMessage();

        // Vérifier si la page generate a été visitée après la génération du lien
        if (Session::has('generate_visited')) {
            // Supprimer l'indicateur de la session
            Session::forget('generate_visited');
            // Rediriger l'utilisateur vers la page create
            return redirect()->route('create');
        }

        // Vérifier si la page generate a été visitée après la génération du lien
        if (Session::has('generate_visited')) {
            // Supprimer l'indicateur de la session
            Session::forget('generate_visited');
            // Rediriger l'utilisateur vers la page create
            return redirect()->route('create');
        }

        $message = $request->input('message');

        // Vérifier d'abord s'il y a déjà un message avec ce token dans la base de données
        $existingMessage = Message::where('token', Session::get('generated_token'))->first();

        // Si un message avec ce token existe déjà, utiliser ce token existant
        if ($existingMessage) {
            $token = $existingMessage->token;
            Session::put('generate_visited', true);
        } else {
            // Sinon, générer un nouveau token
            $token = Str::random(10);
            // Stocker le token en session
            Session::put('generated_token', $token);
            Session::put('generate_visited', true);
        }

        $newMessage = Message::create([
            'content' => $message,
            'token' => $token,
        ]);

        return view('generate', ['token' => $token, 'message' => $newMessage]);
    }

    public function cleanGeneratedMessage()
    {
        if (Session::has('generated_token')) {
            // Supprimer le message correspondant dans la base de données
            Message::where('token', Session::get('generated_token'))->delete();
            // Supprimer le token de session
            Session::forget('generated_token');
        }
    }


    public function showLink($token)
    {
        $message = Message::where('token', $token)->first();

        return $message
            ? view('show', compact('token'))
            : redirect('/block');

    }

    public function validateLink($token)
    {
        // Logique pour marquer le lien comme validé et détruire la trace si nécessaire.

        return redirect()->route('message.show', ['token' => $token]);
    }

    public function showMessage($token)
    {
        $message = Message::where('token', $token)->first();

        if ($message) {
            // Logique pour afficher le message.

            // Supprimer le message de la base de données après l'avoir affiché.
            Message::where('token', $token)->delete();

            // Supprimer le token de la session
            Session::forget('used_token');

            // Stocker le token en session pour le marquer comme utilisé
            Session::put('used_token', $token);

            // Ajouter des en-têtes HTTP pour empêcher la mise en cache de cette page
            return response()->view('message', compact('message'))
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } else {
            return redirect('/block');
        }
    }


    public function regenerateLink()
    {
        // Récupérer le token à partir de la requête
        $token = request('token');

        // Supprimer le message correspondant dans la base de données
        Message::where('token', $token)->delete();

        // Rediriger vers la page de création de lien
        return redirect()->route('create');
    }
}
