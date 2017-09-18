<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use Wgmv\SlackApi\Methods\User;


class UserTest extends TestCase
{

//	private $url = 'https://slack.com/api';
	protected $user;
	protected $api;
	protected $cache;
	protected $methodGroup = 'users';
	protected $fake_response; //not sure if this is the way to do it.

	public function setUp()
	{
		parent::setUp();
//		$api = new SlackApi(new \GuzzleHttp\Client, null);

		$this->api = Mockery::mock('Wgmv\SlackApi\Contracts\SlackApi');
		$this->cache = Mockery::mock('Illuminate\Contracts\Cache\Repository');
		$this->user = new User($this->api);

        $this->fake_response = new \stdClass();
        $this->fake_response->members = [];
	}

    /**
    * Test getPresence
    * @test
    */
    function user_getPresence() {
		$method = $this->methodGroup.".getPresence";
		$user = 'user_id';

		$this->api->shouldReceive('post')->with($method, compact('user'))->andReturn('api called '.$method);
//		$this->cache->shouldReceive('get')->with('__vlz_slackc_userlist', NULL)->once()->andReturn($this->fake_response);

		$response = $this->user->getPresence($user);
    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test info
    * @test
    */
    function user_info() {
		$method = $this->methodGroup.".info";
		$user = 'user_id';

		$this->api->shouldReceive('post')->with($method, compact('user'))->once()->andReturn('api called '.$method);
//		$this->cache->shouldReceive('get')->with('__vlz_slackc_userlist', NULL)->once()->andReturn($this->fake_response);

		$response = $this->user->info($user);
    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test list
    * @test
    */
    function user_lists() {
		$method = $this->methodGroup.".list";

		$this->api->shouldReceive('post')->with($method, [])->andReturn('api called '.$method);

		$response = $this->user->lists();
    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test setActive
    * @test
    */
    function user_set_active() {
		$method = $this->methodGroup.".setActive";

		$this->api->shouldReceive('post')->with($method, [])->andReturn('api called '.$method);

		$response = $this->user->setActive();
    	$this->assertEquals('api called '.$method, $response);
    }

    /**
    * Test setActive
    * @test
    */
    function user_set_presence() {
		$method = $this->methodGroup.".setPresence";
		$presence = 'auto';

		$this->api->shouldReceive('post')->with($method, compact('presence'))->andReturn('api called '.$method);

		$response = $this->user->setPresence($presence);
    	$this->assertEquals('api called '.$method, $response);
    }
}
