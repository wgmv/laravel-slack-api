<?php

namespace Vluzrmos\SlackApi\Traits;

trait Channelinfo
{

	protected $user_id;

	/**
	 * Get an array of channels id's by nicks.
	 *
	 * @param string $identifier
	 * @param int $cacheMinutes Minutes or a Date to cache the results, default 1 minute
	 *
	 * @return String
	 */
	public function getChannelId($identifier, $cacheMinutes = 60) : string
	{
		$channel_id = '';
		$channels = $this->cacheGet('channellist');

		if (empty($channels)) {
			$channels = $this->cachePut('channellist', $this->lists(), $cacheMinutes);
		}

		foreach ($channels->channels as $channel) {
			if ($channel->is_channel && in_array($identifier, [$channel->id, $channel->name])) {
				$channel_id = $channel->id;
			}
		}

		return $channel_id;
	}


    public function noChannelCache()
    {
        $this->cacheForget('channellist');

        return $this;
    }

}