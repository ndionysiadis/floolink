<?php

use App\Console\Commands\CleanUpExpiredLinks;
use Illuminate\Support\Facades\Artisan;

Schedule::command('links:cleanup')->hourly();
