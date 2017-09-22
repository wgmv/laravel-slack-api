<?php

namespace Wgmv\SlackApi\Traits;

trait IdFinder
{

    /**
     * @return $this
     */
    public function find()
    {
        $this->use_id_finder = true;

        return $this;
    }

    /**
     * Get an array of channels id's by nicks.
     *
     * @param string $identifier
     * @param int $cacheMinutes Minutes or a Date to cache the results, default 1 minute
     *
     * @return String
     */
    public function getChannelId($identifier, $cacheMinutes=60) : string
    {
        $cache_id = '__slackadmin_channellist';
        $channel_id = '';

        if(! cache()->has($cache_id)) {
            cache()->put($cache_id, $this->lists(), $cacheMinutes);
        }

        dd($this->lists());

        $channels = cache()->get($cache_id);

        foreach ($channels->channels as $channel) {
            if (($channel->is_channel || $channel->is_group) && in_array($identifier, [$channel->id, $channel->name])) {
                $channel_id = $channel->id;
                break;
            }
        }

        return $channel_id;
    }

    /**
     * Get an array of users id's by nicks.
     *
     * @param string $identifier
     * @param int $cacheMinutes Minutes or a Date to cache the results, default 1 minute
     *
     * @return String
     */
    public function getUserId($identifier, $cacheMinutes = 5) : string
    {
        $user_id = '';
        $cache_id = '__slackadmin_userlist';

        if(! cache()->has($cache_id)) {
            cache()->put($cache_id, $this->lists(), $cacheMinutes);
        }

        $users = cache()->get($cache_id);

        foreach ($users->members as $user) {
            if (isset($user->profile->email) && in_array($identifier, [$user->id, $user->name, $user->profile->email])) {
                $user_id = $user->id;
                break;
            }
        }

        return $user_id;
    }
    
}