# flash-message
A simple package to allow usage of flash messages using session.
Totaly framework and template agnostic.

# Install
To install this package
```
composer require ajani\flash-message
```

# Usage
FlashMessage is KISS oriented. It only offer two major functionnalities :
 - Writing a new flash message in session.
 - Reading and remove a flash message from session.

To use FlashMessage, include `autoload.php` from Composer, and use `use \FlashMessage\FlashMessage`. No need to instanciate class `FlashMessage` as it's a static class.

***Make sure you have enabled session before using FlashMessage or nothing will happen***

## Store a flash message :
When you want to store a flash message, call the method `push($type, $text)` and pass it the `$type` of the message (usually a short string, like `error`, `info`, `success` or `danger`) and the `$text` of the message.
```
<?php
	session_start();
	include('./vendor/autoload.php');
	\FlashMessage\FlashMessage::push('success', 'Congrats, you\'ve just write a message !');
```

## Retrieve a stored message :
When you want to retrieve a previously stored message, you can call two different functions :
 - `next()` to return next unread message and remove it from session.
 - `next_type($type)` to return next unread message of a specific type and remove it from session. 
```
<?php
	session_start();
	include('./vendor/autoload.php');

	while ($message = \FlashMessage\FlashMessage::next())
	{
		echo "Find a flash message.";
		echo "Message type: " . $message['type'];
		echo "Message: " . $message['text'];
	}
```

## Count unread messages
You can count unread messages at any time by calling `count()` method.
```
<?php
	session_start();
	include('./vendor/autoload.php');

	echo "You have " . \FlashMessage\FlashMessage::count() . " unread messages.";
```

