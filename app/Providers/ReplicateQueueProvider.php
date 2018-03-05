<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Infrastructure\ReplicateQueueClient;

class ReplicateQueueProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReplicateQueueClient::class, function ($app) {
            $queueUrl = env('AWS_QUEUE_URL_REPLICATE');
            $sqsClient = $app->make('aws')->createClient('sqs');
            return new ReplicateQueueClient($queueUrl, $sqsClient);
        });
    }
}
