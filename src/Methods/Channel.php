<?php

namespace Wgmv\SlackApi\Methods;

use Wgmv\SlackApi\Contracts\SlackChannel;

class Channel extends SlackMethod implements SlackChannel
{
    protected $methodsGroup = 'channels.';

    /**
     * This method archives a channel.
     *
     * @return array
     */
    public function archive($channel)
    {
        return $this->method('archive', compact('channel'));
    }

    /**
     * This method crate a channel with a given name.
     * @see https://api.slack.com/methods/channels.create
     *
     * @param string $name Name of channel to create
     * @param array $options
     *
     * @example
     * <pre>
     * [
     *    "validate"  => true, // Whether to return errors on invalid channel name instead of modifying it to meet the specified criteria.
     * ]
     *</pre>
     * @return array
     */
    public function create($name, $options = [])
    {
        return $this->method('create', array_merge(compact('name'), $options));
    }

    /**
     * This method returns a portion of messages/events from the specified channel.
     * To read the entire history for a channel, call the method with no `latest` or `oldest` arguments,
     * and then continue paging using the instructions below.
     * @see https://api.slack.com/methods/channels.history
     *
     * @param array $options
     * @example
     * <pre>
     * [
     *    "channel"  => C1234567890, // Channel to fetch history for.
     *    "count"  => 100, // Number of messages to return, between 1 and 1000.
     *    "inclusive"  => true, // Include messages with latest or oldest timestamp in results.
     *    "latest"  => now, // End of time range of messages to include in results.
     *    "oldest"  => 0, // Start of time range of messages to include in results.
     *    "unreads"  => true, // Include unread_count_display in the output?
     * ]
     *</pre>
     * @return array
     */
    public function history($channel, $options = [])
    {
        return $this->method('history', array_merge(compact('channel'), $options));
    }

    /**
     * This method returns information about a team channel.
     *
     * @see https://api.slack.com/methods/channels.info
     *
     * @param array $options
     *
     * @example
     * <pre>
     * [
     *    "include_locale"  => true, // Set this to true to receive the locale for this channel. Defaults to false
     * ]
     *</pre>
     * @return array
     * @return array
     */
    public function info($channel, $options = [])
    {
        return $this->method('info', array_merge(compact('channel'), $options));
    }

    /**
     * This method is used to invite a user to a channel. The calling user must be a member of the channel.
     *
     * @see https://api.slack.com/methods/channels.invite
     *
     * @param string $user
     *
     * @return array
     */
    public function invite($channel, $user)
    {
        return $this->method('invite', compact('channel', 'user'));
    }

    /**
     * This method is used to join a channel. If the channel does not exist, it is created.
     *
     * @see https://api.slack.com/methods/channels.join
     *
     * @param string $name Channel name to join in
     * @param array $options
     *
     * @example
     * <pre>
     * [
     *    "validate"  => true, // Whether to return errors on invalid channel name instead of modifying it to meet the specified criteria.
     * ]
     *</pre>
     * @return array
     * @return array
     */
    public function join($name, $options = [])
    {
        return $this->method('join', array_merge(compact('name'), $options));
    }

    /**
     * This method allows a user to remove another member from a team channel.
     *
     * @see https://api.slack.com/methods/channels.kick
     *
     * @param string $user
     *
     * @return array
     */
    public function kick($channel, $user)
    {
        return $this->method('kick', compact('channel', 'user'));
    }

    /**
     * This method is used to leave a channel.
     *
     * @see https://api.slack.com/methods/channels.leave
     *
     * @return array
     */
    public function leave($channel)
    {
        return $this->method('leave', compact('channel'));
    }

    /**
     * This method returns a list of all channels in the team.
     * This includes channels the caller is in, channels they are not currently in, and archived channels.
     * The number of (non-deactivated) members in each channel is also returned.
     *
     * @see https://api.slack.com/methods/channels.list

     * @param array $options
     *
     * @example
     * <pre>
     * [
     *    "cursor"  => dXNlcjpVMDYxTkZUVDI, // Paginate through collections of data by setting the cursor parameter to a next_cursor attribute returned by a previous request's response_metadata
     *    "exclude_archived"  => false, // Exclude archived channels from the list
     *    "exclude_members"  => false, // Exclude the members collection from each channel
     *    "limit"  => 0, // The maximum number of items to return. Fewer than the requested number of items may be returned, even if the end of the users list hasn't been reached.
     * ]
     *</pre>
     * @return array
     */
    public function lists($options = [])
    {
		return $this->method('list', $options);
    }

    /**
     * This method moves the read cursor in a channel.
     *
     * @see https://api.slack.com/methods/channels.mark
     *
     * @param string|int $ts      Timestamp of the most recently seen message.
     *
     * @return array
     */
    public function mark($channel, $ts)
    {
        return $this->method('mark', compact('channel', 'ts'));
    }

    /**
     * This method renames a team channel.
     *
     * The only people who can rename a channel are team admins, or the person that originally
     * created the channel. Others will receive a "not_authorized" error.
     *
     * @see https://api.slack.com/methods/channels.rename
     *
     * @param  string $name New name for channel
     * @param array $options
     *
     * @example
     * <pre>
     * [
     *    "validate"  => true, // Whether to return errors on invalid channel name instead of modifying it to meet the specified criteria.
     * ]
     *</pre>
     * @return array
     */
    public function rename($channel, $name, $options = [])
    {
        return $this->method('rename', array_merge(compact('channel', 'name'), $options));
    }

	/**
	 * This method returns an entire thread (a message plus all the messages in reply to it).
	 *
	 * @see https://api.slack.com/methods/channels.replies
	 *
	 * @param string|int $thread_ts Unique identifier of a thread's parent message
	 *
	 * @return array
	 */
	public function replies($channel, $thread_ts)
	{
		return $this->method('replies', compact('channel', 'thread_ts'));
	}

    /**
     * This method is used to change the purpose of a channel. The calling user must be a member of the channel.
     *
     * @see https://api.slack.com/methods/channels.setPurpose
     *
     * @param string $purpose The new purpose
     *
     * @return array
     */
    public function setPurpose($channel, $purpose)
    {
        return $this->method('setPurpose', compact('channel', 'purpose'));
    }

    /**
     * This method is used to change the topic of a channel. The calling user must be a member of the channel.
     *
     * @see https://api.slack.com/methods/channels.setTopic
     *
     * @param string $topic
     *
     * @return array
     */
    public function setTopic($channel, $topic)
    {
        return $this->method('setTopic', compact('channel', 'topic'));
    }

    /**
     * This method unarchives a channel. The calling user is added to the channel.
     *
     * @see https://api.slack.com/methods/channels.unarchive
     *
     * @return array
     */
    public function unarchive($channel)
    {
        return $this->method('unarchive', compact('channel'));
    }

}
