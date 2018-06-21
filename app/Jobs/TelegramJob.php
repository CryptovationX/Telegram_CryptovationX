<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\TelegramController;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\TelegramUserController;

class TelegramJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $telegram = new TelegramUserController;
        $telegram->test();
    }
}
