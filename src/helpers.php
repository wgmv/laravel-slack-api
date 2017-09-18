<?php

if (! function_exists('slack')) {

    /**
     * Helper to easy load an slack method or the api.
     * @param  string $method slack method name
     * @return \Wgmv\SlackApi\Contracts|SlackApi|\Wgmv\SlackApi\Methods\SlackMethod
     */
    function slack($method = null)
    {
        $slack = app('Wgmv\SlackApi\Contracts\SlackApi');

        return $method ? $slack->load($method) : $slack;
    }
}
