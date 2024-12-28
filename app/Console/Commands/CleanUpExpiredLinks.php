<?php

namespace App\Console\Commands;

use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanUpExpiredLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'links:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired or self-destructed links from the database';

    public function handle(): void
    {
        $this->cleanExpiredLinks();
        $this->cleanSelfDestructedLinks();
    }

    private function cleanExpiredLinks(): void
    {
        $expiredCount = Link::query()
            ->where('expires_at', '<', Carbon::now())
            ->delete();

        $this->info("{$expiredCount} expired links have been removed.");
    }

    private function cleanSelfDestructedLinks(): void
    {
        $selfDestructCount = Link::query()
            ->where('self_destruct', true)
            ->where('clicks', '>=', 1)
            ->delete();

        $this->info("{$selfDestructCount} self-destructed links have been removed.");
    }
}
