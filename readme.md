## Laravel 5 e Lumen - Slack API

This package provides a simple way to use [Slack API](https://api.slack.com).

[![Latest Stable Version](https://poser.pugx.org/vluzrmos/slack-api/v/stable.svg)](https://packagist.org/packages/vluzrmos/slack-api) [![Total Downloads](https://poser.pugx.org/vluzrmos/slack-api/downloads.svg)](https://packagist.org/packages/vluzrmos/slack-api) [![Latest Unstable Version](https://poser.pugx.org/vluzrmos/slack-api/v/unstable.svg)](https://packagist.org/packages/vluzrmos/slack-api) [![License](https://poser.pugx.org/vluzrmos/slack-api/license.svg)](https://packagist.org/packages/vluzrmos/slack-api)

## Instalation 

<code>composer require vluzrmos/slack-api</code>

## Instalation on Laravel 5
Add to <code>config/app.php</code>

```php
'providers' => [
    Vluzrmos\SlackApi\SlackApiServiceProvider::class,
]
```
> The ::class notation is optional.


and add the Facades to your aliases, if you need it:

```php
[
    'aliases' => [
        'SlackApi'              => Vluzrmos\SlackApi\Facades\SlackApi::class,
        'SlackChannel'          => Vluzrmos\SlackApi\Facades\SlackChannel::class,
        'SlackChat'             => Vluzrmos\SlackApi\Facades\SlackChat::class,
        'SlackGroup'            => Vluzrmos\SlackApi\Facades\SlackGroup::class,
        'SlackFile'             => Vluzrmos\SlackApi\Facades\SlackFile::class,
        'SlackSearch'           => Vluzrmos\SlackApi\Facades\SlackSearch::class,
        'SlackInstantMessage'   => Vluzrmos\SlackApi\Facades\SlackInstantMessage::class,
        'SlackUser'             => Vluzrmos\SlackApi\Facades\SlackUser::class,
        'SlackStar'             => Vluzrmos\SlackApi\Facades\SlackStar::class,
        'SlackUserAdmin'        => Vluzrmos\SlackApi\Facades\SlackUserAdmin::class,
        'SlackRealTimeMessage'  => Vluzrmos\SlackApi\Facades\SlackRealTimeMessage::class,
        'SlackTeam'             => Vluzrmos\SlackApi\Facades\SlackTeam::class,
    ]
]
```
> The ::class notation is optional.

## Instalation on Lumen

Add that line on <code>bootstrap/app.php</code>
```php
// $app->register('App\Providers\AppServiceProvider'); (by default that comes commented)

   $app->register('Vluzrmos\SlackApi\SlackApiServiceProvider');
```

If you want to use facades, add this lines on <code>bootstrap/app.php</code>
```php
class_alias('Vluzrmos\SlackApi\Facades\SlackApi', 'SlackApi');
class_alias('Vluzrmos\SlackApi\Facades\SlackChannel', 'SlackChannel');
class_alias('Vluzrmos\SlackApi\Facades\SlackChat', 'SlackChat');
class_alias('Vluzrmos\SlackApi\Facades\SlackGroup', 'SlackGroup');
class_alias('Vluzrmos\SlackApi\Facades\SlackUser', 'SlackUser');
class_alias('Vluzrmos\SlackApi\Facades\SlackTeam', 'SlackTeam');
//... and others
```

Otherwise, just use the singleton shortcuts:

```php
$slackapi     = app('slack.api');
$slackchat    = app('slack.chat');
$slackchannel = app('slack.channel');
//...
//...
```

## Configuration

configure your slack team token in <code>config/services.php</code> 
```php 
[
    //...,
    'slack' => [
        'token' => 'xop-sp-easeu-erahsuer-esrasher'
    ]
]
```

## Usage
```php
//Lists all users on your team
SlackUser::lists(); //all()

//Lists all channels on your team
SlackChannel::lists(); //all()

//List all groups
SlackGroup::lists(); //all()

//Invite a new member to your team
SlackUserAdmin::invite("example@example.com", [
    'first_name' => 'John', 
    'last_name' => 'Doe'
]);

//Send a message to someone or channel or group
SlackChat::message('#general', 'Hello my friends!');

//Upload a file/snippet
SlackFile::upload([
    'filename' => 'sometext.txt', 
    'title' => 'text', 
    'content' => 'Nice contents',
    'channels' => 'C0440SZU6' //can be channel, users, or groups ID
]);

// Search for files or messages
SlackSearch::all('my message');

// Search for files
SlackSearch::files('my file');

// Search for messages
SlackSearch::messages('my message');
```

## Using Dependencie Injection

```php
<?php 

namespace App\Http\Controllers;    
    
use Vluzrmos\SlackApi\Contracts\SlackUser;

class YourController extends Controller{
    /** @var  SlackUser */
    protected $slackUser;
    
    public function __construct(SlackUser as $slackUser){
        $this->slackUser = $slackUser;   
    }
    
    public function controllerMethod(){
        $usersList = $this->slackUser->lists();
    }
}
```

## All Injectable Contracts:

### Generic API
`Vluzrmos\SlackApi\Contracts\SlackApi`
Allows you to do generic requests to the api with the following http verbs:
`get`, `post`, `put`, `patch`, `delete` ...

All allowed methods you could see here: [Slack Web API Methods](https://api.slack.com/methods).

> Note: All of these methods of that class and others returns an array.

### Channels API
`Vluzrmos\SlackApi\Contracts\SlackChannel`

Allows you to operate channels:
`invite`, `archive`, `rename`, `join`, `kick`, `setPurpose` ...


### Chat API
`Vluzrmos\SlackApi\Contracts\SlackChat`

Allows you to send, update and delete messages with methods:
`delete`, `message`, `update`.

### Files API
`Vluzrmos\SlackApi\Contracts\SlackFile`
Allows you to send, get info, delete,  or just list files:
`info`, `lists`, `upload`, `delete`.

### Groups API
`Vluzrmos\SlackApi\Contracts\SlackGroup`

Same methods of the SlackChannel, but that operates with groups and have adicional methods:
`open`, `close`, `createChild`

### Instant Messages API (Direct Messages)
`Vluzrmos\SlackApi\Contracts\SlackInstantMessage`

Allows you to manage direct messages to your team members.

### Real Time Messages API
`Vluzrmos\SlackApi\Contracts\SlackRealTimeMessage`

Allows you list all channels and user presence at the moment.


### Search API
`Vluzrmos\SlackApi\Contracts\SlackSearch`

Find messages or files.

### Stars API
`Vluzrmos\SlackApi\Contracts\SlackStar`

List all of starred itens.

### Team API
`Vluzrmos\SlackApi\Contracts\SlackTeam`

Get information about your team.

### Users API
`Vluzrmos\SlackApi\Contracts\SlackUser`

Get information about an user on your team or just check your presence ou status.

### Users Admin API
`Vluzrmos\SlackApi\Contracts\SlackUserAdmin`

Invite new members to your team.

## License

[DBAD License](https://dbad-license.org).
