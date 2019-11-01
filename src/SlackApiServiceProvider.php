<?php

namespace Wgmv\SlackApi;

use Illuminate\Support\Str;
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
        'Chat',
        'Conversation',
        'File',
        'Group',
        'InstantMessage',
        'RealTimeMessage',
        'Search',
        'Star',
        'Team',
        'User',
        'UserAdmin',
    ];

    /**
     * Register the service provider.
     */
    public function register()
    {
        /* Lumen autoload services configs */
        if (Str::contains($this->app->version(), 'Lumen')) {
            $this->app->configure('services');
        }

        $this->app->singleton('Wgmv\SlackApi\Contracts\SlackApi', function () {
            return new SlackApi(null, config('services.slack.token'));
        });

        $this->app->alias('Wgmv\SlackApi\Contracts\SlackApi', 'slack.api');

        foreach ($this->methods as $method) {

            $contract = "Wgmv\SlackApi\Contracts\Slack".$method;
            $class = "Wgmv\SlackApi\Methods\\".$method;
            $shortcut = "slack.".Str::snake($method);

            $this->app->singleton($contract, function () use ($class) {
                return new $class($this->app['slack.api']);
            });

            $this->app->alias($contract, $shortcut);
        }

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        $shortcuts[] = 'slack.api';

        foreach ($this->methods as $method) {
            $shortcuts[] = $shortcut = "slack.".Str::snake($method);
        }
        return $shortcuts;
    }

}
