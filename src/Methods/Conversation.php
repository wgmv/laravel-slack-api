<?php

namespace Wgmv\SlackApi\Methods;

use Wgmv\SlackApi\Contracts\SlackConversation;

class Conversation extends SlackMethod implements SlackConversation
{
    protected $methodsGroup = 'conversations.';

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
     * This Conversations API method closes direct messages, multi-person or 1:1 or otherwise.
     *
     * @return array
     */
    public function close($channel)
    {
        return $this->method('close', compact('channel'));
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
     *    "is_private"  => true, // Create a private channel instead of a public one
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
     *    "cursor" => dXNlcjpVMDYxTkZUVDI= Paginate through collections of data by setting the cursor parameter to a next_cursor attribute returned by a previous request's response_metadata. Default value fetches the first "page" of the collection. See pagination for more detail.
     *    "latest"  => now, // End of time range of messages to include in results.
     *    "limit"  => 100, // Number of messages to return, between 1 and 1000.
     *    "inclusive"  => true, // Include messages with latest or oldest timestamp in results.
     *    "oldest"  => 0, // Start of time range of messages to include in results.
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
     * @see https://api.slack.com/methods/conversations.invite
     *
     * @param string $users A comma separated list of user IDs. Up to 30 users may be listed.
     *
     * @return array
     */
    public function invite($channel, $users)
    {
        return $this->method('invite', compact('channel', 'users'));
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
     * @see https://api.slack.com/methods/conversations.kick
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
     * @see https://api.slack.com/methods/conversations.leave
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
//     *    "exclude_members"  => false, // Exclude the members collection from each channel
     *    "limit"  => 0, // The maximum number of items to return. Fewer than the requested number of items may be returned, even if the end of the users list hasn't been reached.
     *    "types= => public_channel,private_channel  default=public_channel Mix and match channel types by providing a comma-separated list of any combination of public_channel, private_channel, mpim, im
     * ]
     *</pre>
     * @return array
     */
    public function lists($options = [])
    {
		return $this->method('list', $options);
    }

    /**
     * This Conversations API method returns a paginated list of members party to a conversation.
     *
     * @see https://api.slack.com/methods/conversations.members
     *
     * @example
     * <pre>
     * [
     *    "cursor"  => dXNlcjpVMDYxTkZUVDI, // Paginate through collections of data by setting the cursor parameter to a next_cursor attribute returned by a previous request's response_metadata. Default value fetches the first "page" of the collection. See pagination for more detail.
     *    "limit"  => 100, // The maximum number of items to return. Fewer than the requested number of items may be returned, even if the end of the users list hasn't been reached.
     * ]
     *</pre>
     * @return array
     *
     * @return array
     */
    public function members($channel, $options = [])
    {
        return $this->method('members', array_merge(compact('channel'), $options));
    }

    /**
     * This Conversations API method opens a multi-person direct message or just a 1:1 direct message.
     * Use conversations.create for public or private channels.
     * Provide 1 to 8 user IDs in the user parameter to open or resume a conversation. Providing only 1 ID will create a direct message. Providing more will create an mpim.
     *
     * @param array $options
     * @example
     * <pre>
     * [
     *    "channel"
     *    "return_im"  => true, // Boolean, indicates you want the full IM channel definition in the response.
     *    "users"  => W1234567890,U2345678901,U3456789012, // Comma separated lists of users. If only one user is included, this creates a 1:1 DM. The ordering of the users is preserved whenever a multi-person direct message is returned. Supply a channel when not supplying users.
     * ]
     *</pre>
     *
     * @return array
     */
    public function open($options = [])
    {
        return $this->method('open', $options);
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
     * @return array
     */
    public function rename($channel, $name)
    {
        return $this->method('rename', compact('channel', 'name'));
    }

	/**
	 * This Conversations API method returns an entire thread (a message plus all the messages in reply to it).
	 *
	 * @see https://api.slack.com/methods/channels.replies
	 *
	 * @param string|int $ts Unique identifier of a thread's parent message
	 *
	 * @return array $options
     * @example
     * <pre>
     * [
     *    "cursor" => dXNlcjpVMDYxTkZUVDI=
     *    "limit"  => true, // Boolean, indicates you want the full IM channel definition in the response.
     * ]
     *</pre>
	 */
	public function replies($channel, $ts, $options = [])
	{
		return $this->method('replies', array_merge(compact('channel', 'ts'), $options));
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
