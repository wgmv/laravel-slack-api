<?php

namespace Tests\Unit;

//use Tests\TestCase;

use PHPUnit\Framework\TestCase;
use Vluzrmos\SlackApi\Methods\Channel;
//use Vluzrmos\SlackApi\SlackApi;
use Mockery;


class ChannelTest extends TestCase
{

//	private $url = 'https://slack.com/api';
	protected $channel;
	protected $api;
	protected $cache;

	public function setUp()
	{
		parent::setUp();
//		$api = new SlackApi(new \GuzzleHttp\Client, null);

		$this->api = Mockery::mock('Vluzrmos\SlackApi\Contracts\SlackApi');
		$this->cache = Mockery::mock('Illuminate\Contracts\Cache\Repository');
		$this->channel = new Channel($this->api, $this->cache);
	}

    /**
    * Test channel archive
    * @test
    */
    function channel_archive() {
		$method = "channels.archive";
		$channel = 'channel_id';

		$this->api->shouldReceive('post')->with($method, ['channel' => $channel])->andReturn('api called '.$method);

		$response = $this->channel->archive($channel);
    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test create
    * @test
    */
    function channel_create() {
		$method = "channels.create";
		$name = 'channel_name';

		$this->api->shouldReceive('post')->with($method, ['name' => $name])->andReturn('api called '.$method);

		$response = $this->channel->create($name);

    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test history
    * @test
    */
    function channel_history() {
		$method = "channels.history";
		$channel = 'channel_id';
		$count = 100;
		$latest = null;
		$oldest = 0;
		$inclusive = 1;

		$this->api->shouldReceive('post')
			->with($method, ['channel' => $channel, 'count' => $count, 'latest' => $latest, 'oldest' => $oldest, 'inclusive' => $inclusive])
			->andReturn('api called '.$method);

		$response = $this->channel->history($channel);

    	$this->assertEquals('api called '.$method, $response);
    }

	/**
	 * Test info
	 * @test
	 */
	function channel_info() {
		$method = "channels.info";
		$channel = 'channel_id';

		$this->api->shouldReceive('post')->with($method, ['channel' => $channel])->andReturn('api called '.$method);

		$response = $this->channel->info($channel);

		$this->assertEquals('api called '.$method, $response);
	}

	/**
	 * Test invite
	 * @test
	 */
	function channel_invite() {
		$method = "channels.invite";
		$channel = 'channel_id';
		$user = 'user_id';

		$this->api->shouldReceive('post')->with($method, ['channel' => $channel, 'user' => $user])->andReturn('api called '.$method);

		$response = $this->channel->invite($channel, $user);

		$this->assertEquals('api called '.$method, $response);
	}

	/**
	 * Test join
	 * @test
	 */
	function channel_join() {
		$method = "channels.join";
		$name = 'channel_name';

		$this->api->shouldReceive('post')->with($method, ['name' => $name])->andReturn('api called '.$method);

		$response = $this->channel->join($name);

		$this->assertEquals('api called '.$method, $response);
	}

	/**
	 * Test kick
	 * @test
	 */
	function channel_kick() {
		$method = "channels.kick";
		$channel = 'channel_id';
		$user = 'user_id';

		$this->api->shouldReceive('post')->with($method, compact('channel', 'user'))->andReturn('api called '.$method);

		$response = $this->channel->kick($channel, $user);

		$this->assertEquals('api called '.$method, $response);
	}


	/**
	 * Test join
	 * @test
	 */
	function channel_leave() {
		$method = "channels.leave";
		$channel = 'channel_id';

		$this->api->shouldReceive('post')->with($method, compact('channel'))->andReturn('api called '.$method);

		$response = $this->channel->leave($channel);

		$this->assertEquals('api called '.$method, $response);
	}

    /**
    * Test all
    * @test
    */
    function channel_all() {
		$method = "channels.list";
		$exclude_archived = 1;

		$this->api->shouldReceive('post')->with($method, ['exclude_archived'=> $exclude_archived])->andReturn('api called '.$method);

		$response = $this->channel->all($exclude_archived);
    	$this->assertEquals('api called '.$method, $response);

		$response = $this->channel->lists($exclude_archived);
    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test mark
    * @test
    */
    function channel_mark() {
		$method = "channels.mark";
		$channel = 'channel_id';
		$ts = 1505160576;

		$this->api->shouldReceive('post')->with($method, compact($channel, $ts))->andReturn('api called '.$method);

		$response = $this->channel->mark($channel, $ts);
    	$this->assertEquals('api called '.$method, $response);

    }

    /**
    * Test rename
    * @test
    */
    function channel_rename() {
		$method = "channels.rename";
		$channel = 'channel_id';
		$name = 'new_name';

		$this->api->shouldReceive('post')->with($method, compact($channel, $name))->andReturn('api called '.$method);

		$response = $this->channel->rename($channel, $name);
    	$this->assertEquals('api called '.$method, $response);

    }
    
    /**
    * Test setPurpose
    * @test
    */
    function channel_set_purpose() {
		$method = "channels.setPurpose";
		$channel = 'channel_id';
		$purpose = 'purpose';

		$this->api->shouldReceive('post')->with($method, compact($channel, $purpose))->andReturn('api called '.$method);

		$response = $this->channel->setPurpose($channel, $purpose);
    	$this->assertEquals('api called '.$method, $response);

    }

    /**
    * Test setTopic
    * @test
    */
    function channel_set_topic() {
		$method = "channels.setTopic";
		$channel = 'channel_id';
		$topic = 'topic';

		$this->api->shouldReceive('post')->with($method, compact($channel, $topic))->andReturn('api called '.$method);

		$response = $this->channel->setTopic($channel, $topic);
    	$this->assertEquals('api called '.$method, $response);

    }

    /**
    * Test unarchive
    * @test
    */
    function channel_unarchive() {
		$method = "channels.unarchive";
		$channel = 'channel_id';

		$this->api->shouldReceive('post')->with($method, compact($channel))->andReturn('api called '.$method);

		$response = $this->channel->unarchive($channel);
    	$this->assertEquals('api called '.$method, $response);

    }

}
