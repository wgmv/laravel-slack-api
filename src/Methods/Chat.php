<?php

namespace Wgmv\SlackApi\Methods;

use Wgmv\SlackApi\Contracts\SlackChat;

class Chat extends SlackMethod implements SlackChat
{
    protected $methodsGroup = 'chat.';

    /**
     * This method deletes a message from a channel.
     *
     * @see https://api.slack.com/methods/chat.delete
     *
     * @param string     $channel Channel containing the message to be deleted.
     * @param int|string $ts    Timestamp of the message to be deleted.
     * @param array $options
     *
     * @example
     * <pre>
     * [
     *    "as_user"  => true, // Pass true to delete the message as the authed user. Bot users in this context are considered authed users.
     * ]
     *</pre>

     * @return array
     */
    public function delete($channel, $ts, $options = [])
    {
        //TODO [Walter] #[20.09.2017]
        // options param needs to be tested
        return $this->method('delete', array_merge(compact('channel', 'ts'), $options));
    }

    /**
     * This method sends a me message to a channel from the calling user
     *
     * @see https://api.slack.com/methods/chat.meMessage
     *
     * @param string     $channel Channel containing the message to be deleted.
     * @param string     $text Text of the message to send.
     *
     * @return array
     */
    public function meMessage($channel, $text)
    {
        return $this->method('meMessage', compact('channel', 'text'));
    }

    /**
     * This method posts a message to a channel.
     *
     * @see https://api.slack.com/methods/chat.postMessage
     *
     * @param string $channel Channel to send message to. Can be a public channel, private group or IM channel. Can be an encoded ID, or a name.
     * @param string $text Text of the message to send. See below for an explanation of formatting.
     * @param array $options
     *
     * @example
     * <pre>
     * [
     *    "username" => "My Bot", //Name of bot.
     *    "as_user"  => true, //Pass true to post the message as the authed user, instead of as a bot
     *    "parse"    => "full", //Change how messages are treated. See below.
     *    "reply_broadcast" => false //Used in conjunction with thread_ts and indicates whether reply should be made visible to everyone in the channel or conversation. Defaults to false.
     *    "link_names" => 1, //Find and link channel names and usernames.
     *    "attachments" => ["pretext" => "pre-hello", "text" => "text-world"], //Structured message attachments.
     *	  "unfurl_links" => true, //Pass true to enable unfurling of primarily text-based content.
     *    "unfurl_media" => true, //Pass false to disable unfurling of media content.
     *    "icon_url" => "http://lorempixel.com/48/48", //URL to an image to use as the icon for this message
     *    "icon_emoji"=> ":chart_with_upwards_trend:" //emoji to use as the icon for this message. Overrides icon_url.
     * ]
     *</pre>
     * @return array
     */
    public function postMessage($channel, $text, $options = [])
    {
        return $this->method('postMessage', array_merge(compact('channel', 'text'), $options)); //), ['as_user' => ! isset($options['username'])],
    }

    /**
     * Alias to postMessage().
     * @see https://api.slack.com/methods/chat.postMessage
     *
     * @param string $channel Channel to send message to. Can be a public channel, private group or IM channel. Can be an encoded ID, or a name.
     * @param string $text Text of the message to send. See below for an explanation of formatting.
     * @param array $options
     *
     * @example
     * <pre>
     * [
     *    "as_user"  => true, // Pass true to post the message as the authed user, instead of as a bot. Defaults to false. See authorship below.
     *    "attachments"  => 	[{"pretext": "pre-hello", "text": "text-world"}], // 	[{"pretext": "pre-hello", "text": "text-world"}]
     *    "icon_emoji"  => :chart_with_upwards_trend:,  //Emoji to use as the icon for this message. Overrides icon_url. Must be used in conjunction with as_user set to false, otherwise ignored. See authorship below.
     *    "icon_url"  => http://lorempixel.com/48/48,  //URL to an image to use as the icon for this message. Must be used in conjunction with as_user set to false, otherwise ignored. See authorship below.
     *    "link_names"  => true,  //Find and link channel names and usernames.
     *    "parse"  => full,  //Change how messages are treated. Defaults to none. See below
     *    "reply_broadcast" => true //Used in conjunction with thread_ts and indicates whether reply should be made visible to everyone in the channel or conversation. Defaults to false.
     *    "thread_ts" => 1234567890.123456 //Provide another message's ts value to make this message a reply. Avoid using a reply's ts value; use its parent instead.
     *	  "unfurl_links" => true, //Pass true to enable unfurling of primarily text-based content.
     *    "unfurl_media" => false, //Pass false to disable unfurling of media content.
     *    "username" => My Bot, //Set your bot's user name. Must be used in conjunction with as_user set to false, otherwise ignored. See authorship below.
     *
     * ]
     *</pre>
     *
     * @return array
     */
    public function message($channel, $text, $options = [])
    {
        return $this->message($channel, $text, $options);
    }

    /**
     * This method updates a message in a channel.
     *
     * @param string $channel Channel containing the message to be updated.
     * @param string $text New text for the message, using the default formatting rules.
     * @param int|string $ts Timestamp of the message to be updated.
     * @param array $options
     *
     * @example
     * <pre>
     * [
     *    "username" => "My Bot", //Name of bot.
     *    "as_user"  => true, //Pass true to post the message as the authed user, instead of as a bot
     *    "parse"    => "full", //Change how messages are treated. See below.
     *    "link_names" => 1, //Find and link channel names and usernames.
     *    "attachments" => ["pretext" => "pre-hello", "text" => "text-world"], //Structured message attachments.
     *    "parse"=> "none" //Change how messages are treated. Defaults to client, unlike chat.postMessage. See https://api.slack.com/methods/chat.update#formatting.
     * ]
     *</pre>
     * @return array
     */
    public function update($channel, $text, $ts, $options = [])
    {
        return $this->method('update', array_merge(compact('channel', 'text', 'ts'), $options));
    }
}
