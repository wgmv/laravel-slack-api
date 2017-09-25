<?php

namespace Wgmv\SlackApi\Contracts;

interface SlackFile
{
    public function delete($file);
    public function info($file, $options = []);
    public function lists($options = []);
    public function upload();
}
