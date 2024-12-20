<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanUpExpiredLinks extends Command
{
    protected $signature = 'links:cleanup';
    protected $description = 'Remove expired or self-destructed links from the database';

    public function handle(): void
    {
        DB::table('links')->where('expires_at', '<', Carbon::now())->delete();
        DB::table('links')->where('self_destruct', true)->where('clicks', '>=', 1)->delete();
        $this->info('Expired and self-destructed links cleaned up successfully!');
    }
}
