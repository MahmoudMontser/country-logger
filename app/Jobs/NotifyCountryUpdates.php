<?php

namespace App\Jobs;

use App\Http\Resources\CountryLogResource;
use App\Http\Resources\CountryResource;
use App\Models\CountryRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;


class NotifyCountryUpdates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $log)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $callbacks=CountryRequest::all();
        foreach ($callbacks as $callback)
            if ($callback->callback_url){
                try {
                    $response = Http::post($callback->callback_url, [
                        "country" => CountryResource::make($this->log->country()),
                        "log"=>CountryLogResource::make($this->log)
                    ]);
                }catch (\Throwable $exception ){

                }

            }

    }
}
