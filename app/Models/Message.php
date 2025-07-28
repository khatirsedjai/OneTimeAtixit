<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'token', 'created_at'];

    // Désactiver updated_at mais garder created_at
    const UPDATED_AT = null;

    // Méthode pour nettoyer automatiquement les messages expirés
    public static function cleanExpiredMessages()
    {
        // Supprimer les messages de plus de 7 jours
        self::where('created_at', '<', Carbon::now()->subDays(7))->delete();
    }

    // Vérifier si un message est expiré
    public function isExpired()
    {
        return $this->created_at && $this->created_at->addDays(7)->isPast();
    }
}
