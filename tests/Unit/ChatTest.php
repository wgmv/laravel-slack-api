<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use Wgmv\SlackApi\Methods\Chat;
use Wgmv\SlackApi\Methods\User;


class ChatTest extends TestCase
{

//	private $url = 'https://slack.com/api';
	protected $chat;
	protected $api;
	protected $methodGroup = 'chat';
	protected $fake_response; //not sure if this is the way to do it.

	public function setUp()
	{
		parent::setUp();
		$this->api = Mockery::mock('Wgmv\SlackApi\Contracts\SlackApi');
//		$this->user = new User($this->api);
		$this->chat = new Chat($this->api);

        $this->fake_response = new \stdClass();
        $this->fake_response->members = [];
	}

    /**
    * Test delete
    * @test
    */
    function chat_delete() {
		$method = $this->methodGroup.".delete";
		$channel = 'channel_id';
		$ts = 1234567890;
		$options = [];

		$this->api->shouldReceive('post')->with($method, array_merge(compact('channel', 'ts'), $options))->andReturn('api called '.$method);

		$response = $this->chat->delete($channel, $ts, $options);
    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test meMessage
    * @test
    */
    function chat_meMessage() {
		$method = $this->methodGroup.".meMessage";
		$channel = 'channel_id';
		$text = 'Hello';

		$this->api->shouldReceive('post')->with($method, compact('channel', 'text'))->andReturn('api called '.$method);

		$response = $this->chat->meMessage($channel, $text);
    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test message
    * @test
    */
    function chat_postMessage() {
		$method = $this->methodGroup.".postMessage";
		$channel = 'channel_id';
		$text = 'Hello';
		$options = [];

		$this->api->shouldReceive('post')->with($method, array_merge(compact('channel', 'text'), $options))->andReturn('api called '.$method);

		$response = $this->chat->postMessage($channel, $text, $options);
    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test update
    * @test
    */
    function chat_update() {
		$method = $this->methodGroup.".update";
		$channel = 'channel_id';
		$text = 'Hello';
		$ts = 123456789;

		$this->api->shouldReceive('post')->with($method, compact('channel', 'text', 'ts'))->andReturn('api called '.$method);

		$response = $this->chat->update($channel, $text, $ts);
    	$this->assertEquals('api called '.$method, $response);
    }

}
