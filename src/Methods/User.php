<?php

namespace Wgmv\SlackApi\Methods;

use Wgmv\SlackApi\Contracts\SlackUser;
use Wgmv\SlackApi\Traits\IdFinder;

class User extends SlackMethod implements SlackUser
{
    use IdFinder;

    protected $methodsGroup = 'users.';

    protected $use_id_finder = false;

    /**
     * This method lets you find out information about a user's presence.
     * Consult the presence documentation for more details.
     *
     * @param string $user User ID to get presence info on. Defaults to the authed user.
     *
     * @return array
     */
    public function getPresence($user)
    {
        $user = $this->use_id_finder ? $this->getUserId($user) : $user;

        return $this->method('getPresence', compact('user'));
    }

    /**
     * This method returns information about a team member.
     *
     * @param string $user User to get info on
     *
     * @return array
     */
    public function info($user)
    {
        $user = $this->use_id_finder ? $this->getUserId($user) : $user;

        return $this->method('info', compact('user'));
    }

    /**
     * This method returns a list of all users in the team. This includes deleted/deactivated users.
     *
     * @return array
     */
    public function lists()
    {
        return $this->method('list');
    }

    /**
     * This method lets the slack messaging server know that the authenticated user is currently active.
     * Consult the presence documentation for more details.
     *
     * @return array
     */
    public function setActive()
    {
        return $this->method('setActive');
    }

    /**
     * This method lets you set the calling user's manual presence.
     * Consult the presence documentation for more details.
     *
     * @param $presence
     *
     * @return array
     */
    public function setPresence($presence)
    {
        return $this->method('setPresence', compact('presence'));
    }

}
