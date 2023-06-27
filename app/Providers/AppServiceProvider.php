<?php

namespace App\Providers;

use App\Services\DataLoader;
use App\Services\UserPostService;
use App\Services\UserService;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        /**
         * Define DataLoader instance as singleton
         * and add handlers to it.
         */
        $this->app->singleton(DataLoader::class, function($app) {
            $users = $app->make(UserService::class);
            $posts = $app->make(UserPostService::class);
            $client = $app->make(PendingRequest::class);

            $dataLoader = new DataLoader($client);
            $dataLoader->addHandler('https://gorest.co.in/public/v2/users', $users);
            $dataLoader->addHandler('https://gorest.co.in/public/v2/posts', $posts);

            return $dataLoader;
        });
    }
}
