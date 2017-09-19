## Laravel 5 and Lumen - Slack API

This package provides a simple way to use the [Slack API](https://api.slack.com).

The package is a fork from https://github.com/Vluzrmos/laravel-slack-api The original package is not maintained and I made several changes that possibly make this version incompatible to the original.

### Changes made:

* removed functionality to lookup user by nickname: this package provides basic functionality 
* removed cache as it was not needed anymore
* added basic tests
* updated slack api options on a couple of methods
* fixed minor bugs

<!---
[![Latest Stable Version](https://poser.pugx.org/Wgmv/slack-api/v/stable.svg)](https://packagist.org/packages/Wgmv/slack-api) [![Total Downloads](https://poser.pugx.org/Wgmv/slack-api/downloads.svg)](https://packagist.org/packages/Wgmv/slack-api) [![Latest Unstable Version](https://poser.pugx.org/Wgmv/slack-api/v/unstable.svg)](https://packagist.org/packages/Wgmv/slack-api) [![License](https://poser.pugx.org/Wgmv/slack-api/license.svg)](https://packagist.org/packages/Wgmv/slack-api)
-->

## Installation 

`composer require wgmv/laravel-slack-api`

## Installation on Laravel 5

The package has autodiscovery enabled. (A laravel 5.5 feature)

```php
<?php

[
    'providers' => [
        Wgmv\SlackApi\SlackApiServiceProvider::class,
    ]
]

?>
```

## Configuration

This package uses slacks legacy tokens. Get you token here:

https://api.slack.com/custom-integrations/legacy-tokens

Configure your slack team token in <code>config/services.php</code> 

```php 
<?php

[
    //...,
    'slack' => [
        'token' => 'your token here'
    ]
]

?>
```


## Installation on Lumen

I have not tested the lumen installation! Documentation from the original package:

Add the following line on `bootstrap/app.php`:

```php
<?php

// $app->register('App\Providers\AppServiceProvider'); (by default that comes commented)
$app->register('Wgmv\SlackApi\SlackApiServiceProvider');

?>
```

If you want to use facades, add this lines on <code>bootstrap/app.php</code>

```php
<?php

class_alias('Wgmv\SlackApi\Facades\SlackApi', 'SlackApi');
//... and others

?>
```

Otherwise, just use the singleton shortcuts:

```php
<?php
/** @var \Wgmv\SlackApi\Contracts\SlackApi $slackapi */
$slackapi     = app('slack.api');

/** @var \Wgmv\SlackApi\Contracts\SlackChannel $slackchannel */
$slackchannel = app('slack.channel');

etc
?>
```

## Example Usage

```php
<?php

//Lists all users on your team
SlackUser::lists(); 

//Lists all channels on your team
SlackChannel::lists(); 

//List all groups
SlackGroup::lists();

//Invite a new member to your team
SlackUserAdmin::invite("example@example.com", [
    'first_name' => 'John', 
    'last_name' => 'Doe'
]);

// or just use the helper

//Autoload the api
slack()->post('chat.postMessage', [...]);

//Autoload a Slack Method
slack('Chat')->message([...]);
slack('Team')->info();

?>
```

## All Injectable Contracts:

### Generic API
`Wgmv\SlackApi\Contracts\SlackApi`

Allows you to do generic requests to the api with the following http verbs:
`get`, `post`, `put`, `patch`, `delete` ... all allowed api methods you could see here: [Slack Web API Methods](https://api.slack.com/methods).

<!--
And is also possible load a SlackMethod contract:

```php
<?php 

/** @var SlackChannel $channel **/
$channel = $slack->load('Channel');
$channel->lists();

/** @var SlackChat $chat **/
$chat = $slack->load('Chat');
$chat->message('D98979F78', 'Hello my friend!');

/** @var SlackUserAdmin $chat **/
$admin = $slack('UserAdmin'); //Minimal syntax (invokable)
$admin->invite('jhon.doe@example.com'); 

?>
```
-->

### Channels API
`Wgmv\SlackApi\Contracts\SlackChannel`

Allows you to operate channels:
`invite`, `archive`, `rename`, `join`, `kick`, `setPurpose` ...


### Chat API
`Wgmv\SlackApi\Contracts\SlackChat`

Allows you to send, update and delete messages with methods:
`delete`, `message`, `update`.

### Files API
`Wgmv\SlackApi\Contracts\SlackFile`

Allows you to send, get info, delete,  or just list files:
`info`, `lists`, `upload`, `delete`.

### Groups API
`Wgmv\SlackApi\Contracts\SlackGroup`

Same methods of the SlackChannel, but that operates with groups and have adicional methods:
`open`, `close`, `createChild`

### Instant Messages API (Direct Messages)
`Wgmv\SlackApi\Contracts\SlackInstantMessage`

Allows you to manage direct messages to your team members.

### Real Time Messages API
`Wgmv\SlackApi\Contracts\SlackRealTimeMessage`

Allows you list all channels and user presence at the moment.


### Search API
`Wgmv\SlackApi\Contracts\SlackSearch`

Find messages or files.

### Stars API
`Wgmv\SlackApi\Contracts\SlackStar`

List all of starred itens.

### Team API
`Wgmv\SlackApi\Contracts\SlackTeam`

Get information about your team.

### Users API
`Wgmv\SlackApi\Contracts\SlackUser`

Get information about an user on your team or just check your presence ou status.

### Users Admin API
`Wgmv\SlackApi\Contracts\SlackUserAdmin`

Invite new members to your team.

## License

[DBAD License](https://dbad-license.org).
