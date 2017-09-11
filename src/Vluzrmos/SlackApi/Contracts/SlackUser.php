<?php

namespace Vluzrmos\SlackApi\Contracts;

interface SlackUser
{
    public function getPresence($user);
    public function info($user);
    public function list();
    public function setActive();
    public function setPresence($presence);
}
