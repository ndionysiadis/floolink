<?php

namespace App\Console\Commands;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CleanUpExpiredLinks extends Command
{
    protected $signature = 'links:cleanup';
    protected $description = 'Remove expired floolinks from the database with magic';

    public function handle(): void
    {
        $this->cleanExpiredLinks();
    }

    private function cleanExpiredLinks(): void
    {
        $expiredCount = Link::query()
            ->where('expires_at', '<', Carbon::now())
            ->delete();

        $message = "Avada Kedavra! {$expiredCount} expired floolink(s) have been destroyed!";

        $this->info($message);
        Log::info($message);
    }
}
