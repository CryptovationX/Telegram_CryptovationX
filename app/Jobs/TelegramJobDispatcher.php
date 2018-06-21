<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;

class TelegramJobDispatcher implements ShouldQueue
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
        TelegramJobDispatcher::dispatch()->delay(Carbon::now()->addMinutes(2));
        TelegramJob::dispatch();
    }
}
