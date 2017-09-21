<?php

namespace Wgmv\SlackApi\Contracts;

interface SlackChannel
{
    public function archive($channel);
    public function create($name, $options = []);
    public function history($channel, $options = []);
    public function info($channel, $options = []);
    public function invite($channel, $user);
    public function join($name, $options = []);
    public function kick($channel, $user);
    public function leave($channel);
    public function lists($options = []);
    public function mark($channel, $ts);
    public function rename($channel, $name, $options = []);
    public function setPurpose($channel, $purpose);
    public function setTopic($channel, $topic);
    public function unarchive($channel);
}
