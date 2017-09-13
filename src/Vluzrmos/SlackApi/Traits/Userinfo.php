<?php

namespace Vluzrmos\SlackApi\Traits;

trait Userinfo
{

	protected $user_id;

	/**
	 * Get an array of users id's by nicks.
	 *
	 * @param string $identifier
	 * @param bool         $force force to reload the users list
	 *
	 * @param int          $cacheMinutes Minutes or a Date to cache the results, default 1 minute
	 *
	 * @return String
	 */
	public function getUserId($identifier, $force = false, $cacheMinutes = 1) : string
	{
		$user_id = '';
		$users = $this->cacheGet('userlist');

		if (!$users || $force) {
			$users = $this->cachePut('userlist', $this->lists(), $cacheMinutes);
		}

		foreach ($users->members as $user) {
			if ($user->id == $identifier || $user->name == $identifier || $user->profile->email == $identifier) {
				$user_id = $user->id;
			}
		}

		return $user_id;
	}

//	/**
//	 * Get an array of users id's by nicks.
//	 *
//	 * @param string|array $nicks
//	 * @param bool         $force force to reload the users list
//	 *
//	 * @param int          $cacheMinutes Minutes or a Date to cache the results, default 1 minute
//	 *
//	 * @return array
//	 */
//	public function getUsersIDsByNicks($nicks, $force = false,  $cacheMinutes = 1)
//	{
//		$users = $this->cacheGet('list');
//
//		if (! $users || $force) {
//			$users = $this->cachePut('list', $this->lists(), $cacheMinutes);
//		}
//
//		if (! is_array($nicks)) {
//			$nicks = preg_split('/, ?/', $nicks);
//		}
//
//		$usersIds = [];
//
//		foreach ($users->members as $user) {
//			foreach ($nicks as $nick) {
//				if ($this->isUserNick($user, $nick)) {
//					$usersIds[] = $user->id;
//				} elseif ($this->isSlackbotNick($nick)) {
//					$usersIds[] = 'USLACKBOT';
//				}
//			}
//		}
//
//		return $usersIds;
//	}

}