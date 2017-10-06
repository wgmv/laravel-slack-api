<?php

namespace Wgmv\SlackApi\Contracts;

interface SlackConversation
{
    public function archive($channel);
    public function close($channel);
    public function create($name, $options = []);
    public function history($channel, $options = []);
    public function info($channel, $options = []);
    public function invite($channel, $user);
    public function join($name, $options = []);
    public function kick($channel, $user);
    public function leave($channel);
    public function lists($options = []);
    public function members($channel, $options = []);
    public function open($channel);
    public function rename($channel, $name);
    public function replies($channel, $ts, $options = []);
    public function setPurpose($channel, $purpose);
    public function setTopic($channel, $topic);
    public function unarchive($channel);
}
