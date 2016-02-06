<?php
/*
 * This file is part of the nia framework architecture.
 *
 * (c) Patrick Ullmann <patrick.ullmann@nat-software.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types = 1);
namespace Test\Nia\EventDispatcher;

use PHPUnit_Framework_TestCase;
use Nia\EventDispatcher\Dispatcher;
use Nia\EventDispatcher\DispatcherInterface;
use Nia\EventDispatcher\Provider\ProviderInterface;
use Nia\EventDispatcher\Listener\ClosureListener;
use Nia\EventDispatcher\Listener\ListenerInterface;
use Nia\EventDispatcher\Event\EventInterface;
use Nia\EventDispatcher\Event\Event;

/**
 * Unit test for \Nia\EventDispatcher\Dispatcher.
 */
class DispatcherTest extends PHPUnit_Framework_TestCase
{

    /**
     * @covers \Nia\EventDispatcher\Dispatcher::registerListener
     */
    public function testRegisterListener()
    {
        $listener = new ClosureListener(function () {});

        $dispatcher = new Dispatcher();
        $this->assertSame($dispatcher, $dispatcher->registerListener('foo', $listener));
        $this->assertSame($dispatcher, $dispatcher->registerListener('foo', $listener));

        $this->assertSame([], $dispatcher->getListeners('bar'));
        $this->assertSame([
            $listener,
            $listener
        ], $dispatcher->getListeners('foo'));
    }

    /**
     * @covers \Nia\EventDispatcher\Dispatcher::registerProvider
     */
    public function testRegisterProvider()
    {
        $listener = new ClosureListener(function () {});

        $provider = new class($listener) implements ProviderInterface {

            private $listener = null;

            public function __construct(ListenerInterface $listener)
            {
                $this->listener = $listener;
            }

            public function register(DispatcherInterface $dispatcher)
            {
                $dispatcher->registerListener('test', $this->listener);
            }
        };

        $dispatcher = new Dispatcher();
        $this->assertSame($dispatcher, $dispatcher->registerProvider($provider));

        $this->assertSame([
            $listener
        ], $dispatcher->getListeners('test'));
    }

    /**
     * @covers \Nia\EventDispatcher\Dispatcher::removeListener
     */
    public function testRemoveListener()
    {
        $listener = new ClosureListener(function () {});

        $dispatcher = new Dispatcher();

        // initial value test.
        $this->assertSame([], $dispatcher->getListeners('foo'));
        $this->assertSame([], $dispatcher->getListeners('bar'));

        $dispatcher->registerListener('foo', $listener);
        $dispatcher->registerListener('bar', $listener);

        // remove listener
        $this->assertSame($dispatcher, $dispatcher->removeListener('foo', $listener));

        // test after remove.
        $this->assertSame([], $dispatcher->getListeners('foo'));
        $this->assertSame([
            $listener
        ], $dispatcher->getListeners('bar'));
    }

    /**
     * @covers \Nia\EventDispatcher\Dispatcher::hasListeners
     */
    public function testHasListeners()
    {
        $listener = new ClosureListener(function () {});

        $dispatcher = new Dispatcher();
        $this->assertSame(false, $dispatcher->hasListeners('foo'));
        $this->assertSame($dispatcher, $dispatcher->registerListener('foo', $listener));
        $this->assertSame(true, $dispatcher->hasListeners('foo'));
    }

    /**
     * @covers \Nia\EventDispatcher\Dispatcher::getListeners
     */
    public function testGetListeners()
    {
        $listener = new ClosureListener(function () {});

        $dispatcher = new Dispatcher();
        $dispatcher->registerListener('foo', $listener);

        $this->assertSame([], $dispatcher->getListeners('bar'));
        $this->assertSame([
            $listener
        ], $dispatcher->getListeners('foo'));
    }

    /**
     * @covers \Nia\EventDispatcher\Dispatcher::dispatch
     */
    public function testDispatch()
    {
        $listenedFoo = [];
        $listenedBar = [];

        $listenerFoo = new ClosureListener(function (EventInterface $event) use(&$listenedFoo) {
            $listenedFoo[] = $event;
        });
        $listenerBar = new ClosureListener(function (EventInterface $event) use(&$listenedBar) {
            $listenedBar[] = $event;
        });

        $event = new Event();

        $dispatcher = new Dispatcher();
        $dispatcher->registerListener('foo', $listenerFoo);
        $dispatcher->registerListener('foo', $listenerFoo);
        $dispatcher->registerListener('bar', $listenerBar);

        $dispatcher->dispatch('foo', $event);
        $dispatcher->dispatch('bar', $event);

        $this->assertSame([
            $event,
            $event
        ], $listenedFoo);
        $this->assertSame([
            $event
        ], $listenedBar);
    }
}
