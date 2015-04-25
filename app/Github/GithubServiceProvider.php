<?php namespace Notes\Github;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class GithubServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Notes\Github\GithubInterface', function($app)
        {
            return new Github(new Client(['base_url' => 'https://api.github.com']));
        });
    }
}