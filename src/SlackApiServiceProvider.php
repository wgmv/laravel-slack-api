<?php

namespace Wgmv\SlackApi;

use Illuminate\Support\ServiceProvider;

class SlackApiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Methods to register.
     * @var array
     */
    protected $methods = [
        'Channel',
        'Group',
        'Chat',
        'InstantMessage',
        'Search',
        'File',
        'User',
        'Team',
        'Star',
        'RealTimeMessage',
        'UserAdmin',
    ];

    /**
     * Register the service provider.
     */
    public function register()
    {
        /* Lumen autoload services configs */
        if (str_contains($this->app->version(), 'Lumen')) {
            $this->app->configure('services');
        }

        $this->app->singleton('Wgmv\SlackApi\Contracts\SlackApi', function () {
            return new SlackApi(null, config('services.slack.token'));
        });

        $this->app->alias('Wgmv\SlackApi\Contracts\SlackApi', 'slack.api');

        foreach ($this->methods as $method) {

            $contract = "Wgmv\SlackApi\Contracts\Slack{$method}";
            $class = "Wgmv\SlackApi\Methods\{$method}";
            $shortcut = "slack.".snake_case($method);


            $this->app->singleton($contract, function () use ($class) {
                return new $class($this->app['slack.api']);
            });

            $this->app->alias($contract, $shortcut);
        }

    }

}
