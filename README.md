# nia - event dispatcher component

Library for simple event dispatching.

## Installation

Require this package with Composer.

```bash
	composer require nia/eventdispatcher
```

## Tests
To run the unit test use the following command:

    $ cd /path/to/nia/component/
    $ phpunit --bootstrap=vendor/autoload.php tests/

## Sample: How to use it
The following sample shows you how to use this component in a simple way. It uses the `Nia\EventDispatcher\Listener\ClosureListener` class and the `Nia\EventDispatcher\Event\Event` class.

If you need more event data, just implement the `Nia\EventDispatcher\Event\EventInterface` interface and use the `Nia\EventDispatcher\Event\EventTrait` in your implementation which contains the basic functionality.

For a non-closure listener you must implement the `Nia\EventDispatcher\Listener\ListenerInterface`. Listener providers must implement the `Nia\EventDispatcher\Provider\ProviderInterface`.

```php

    $dispatcher = new Dispatcher();

    // user.register (on registration process)
    $dispatcher->registerListener('user.register', new ClosureListener(function(EventInterface $event) {
        var_dump('event called in listener 1: user.register');
    }));
    $dispatcher->registerListener('user.register', new ClosureListener(function(EventInterface $event) {
        var_dump('event called in listener 2: user.register');
    }));

    // user.registered (after registration process)
    $dispatcher->registerListener('user.registered', new ClosureListener(function(EventInterface $event) {
        var_dump('event called in listener 3: user.registered');
    }));


    // send event _on_ user registration process
    $dispatcher->dispatch('user.register', new Event());

    // register user in database
    // [...]

    // send event _after_ user registration process
    $dispatcher->dispatch('user.registered', new Event());
```
