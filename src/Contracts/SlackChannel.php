<?php

namespace Wgmv\SlackApi\Contracts;

interface SlackChannel
{
    public function archive($channel);
    public function create($name, $validate);
    public function history($channel, $count, $latest, $oldest, $inclusive, $unreads);
    public function info($channel, $include_locale);
    public function invite($channel, $user);
    public function join($name, $validate);
    public function kick($channel, $user);
    public function leave($channel);
    public function lists($cursor, $exclude_archived, $exclude_members, $limit);
    public function mark($channel, $ts);
    public function rename($channel, $name, $validate);
    public function setPurpose($channel, $purpose);
    public function setTopic($channel, $topic);
    public function unarchive($channel);
}
