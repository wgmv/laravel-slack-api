<?php

namespace Wgmv\SlackApi\Contracts;

interface SlackGroup extends SlackChannel
{
    public function open($channel);
    public function close($channel);
    public function createChild($channel);
}
