<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Message;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function create()
    {
        // Nettoyer les messages expirés à chaque visite
        Message::cleanExpiredMessages();

        return view('create');
    }

    public function generateLink(Request $request)
    {
        // Validation du message
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $message = $request->input('message');

        // Nettoyer les messages expirés
        Message::cleanExpiredMessages();

        // NE PLUS nettoyer l'ancien message - on garde tous les liens actifs
        // $this->cleanGeneratedMessage(); // ← SUPPRIMÉ

        // Générer un nouveau token unique
        $token = Str::random(10);

        // Créer le nouveau message avec timestamp
        $newMessage = Message::create([
            'content' => $message,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Stocker le nouveau token en session (optionnel maintenant)
        Session::put('last_generated_token', $token);

        return view('generate', [
            'token' => $token,
            'message' => $newMessage
        ]);
    }

    public function cleanGeneratedMessage()
    {
        // Cette méthode n'est plus utilisée pour la génération
        // mais on la garde pour d'autres usages si nécessaire
        if (Session::has('generated_token')) {
            Message::where('token', Session::get('generated_token'))->delete();
            Session::forget('generated_token');
        }
    }

    public function showLink($token)
    {
        // Nettoyer les messages expirés
        Message::cleanExpiredMessages();

        $message = Message::where('token', $token)->first();

        // Vérifier si le message existe et n'est pas expiré
        if ($message && !$message->isExpired()) {
            return view('show', compact('token'));
        } else {
            // Si le message était expiré, le supprimer
            if ($message && $message->isExpired()) {
                $message->delete();
            }
            return redirect('/block');
        }
    }

    public function validateLink($token)
    {
        return redirect()->route('message.show', ['token' => $token]);
    }

    public function showMessage($token)
    {
        $message = Message::where('token', $token)->first();

        if ($message && !$message->isExpired()) {
            // Supprimer le message de la base de données après l'avoir affiché
            Message::where('token', $token)->delete();

            // Supprimer le token de la session
            Session::forget('used_token');

            // Stocker le token en session pour le marquer comme utilisé
            Session::put('used_token', $token);

            // Ajouter des en-têtes HTTP pour empêcher la mise en cache
            return response()->view('message', compact('message'))
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } else {
            // Si le message était expiré, le supprimer
            if ($message && $message->isExpired()) {
                $message->delete();
            }
            return redirect('/block');
        }
    }

    public function regenerateLink(Request $request)
    {
        // Récupérer le token à partir de la requête
        $token = $request->input('token');

        // GARDER le message existant - ne pas le supprimer
        // Message::where('token', $token)->delete(); // ← SUPPRIMÉ

        // Nettoyer seulement la session
        Session::forget(['last_generated_token', 'generated_token']);

        // Rediriger vers la page de création de lien
        return redirect()->route('create');
    }
}
