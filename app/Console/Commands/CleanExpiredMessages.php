<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message;

class CleanExpiredMessages extends Command
{
    protected $signature = 'messages:clean-expired';
    protected $description = 'Nettoie les messages expirés (plus de 7 jours)';

    public function handle()
    {
        $deletedCount = Message::where('created_at', '<', now()->subDays(7))->count();
        Message::cleanExpiredMessages();

        $this->info("✅ {$deletedCount} messages expirés supprimés.");

        return 0;
    }
}
