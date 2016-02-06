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
namespace Test\Nia\EventDispatcher\Listener;

use PHPUnit_Framework_TestCase;
use Nia\EventDispatcher\Listener\CompositeListener;
use Nia\EventDispatcher\Event\EventInterface;
use Nia\EventDispatcher\Event\Event;
use Nia\EventDispatcher\Listener\ClosureListener;

/**
 * Unit test for \Nia\EventDispatcher\Listener\CompositeListener.
 */
class CompositeListenerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @covers \Nia\EventDispatcher\Listener\CompositeListener
     */
    public function testComposite()
    {
        $listener = new ClosureListener(function (EventInterface $event) {});

        $composite = new CompositeListener([
            $listener,
            $listener
        ]);

        $this->assertSame([
            $listener,
            $listener
        ], $composite->getListeners());

        $this->assertSame($composite, $composite->addListener($listener));

        $this->assertSame([
            $listener,
            $listener,
            $listener
        ], $composite->getListeners());

        $this->assertSame($composite, $composite->removeListener($listener));

        $this->assertSame([
            $listener,
            $listener
        ], $composite->getListeners());
    }

    /**
     * @covers \Nia\EventDispatcher\Listener\CompositeListener::listen
     */
    public function testListen()
    {
        $eventsToSend = [
            new Event(),
            new Event(),
            new Event()
        ];

        $requredListenedEvents = [
            $eventsToSend[0],
            $eventsToSend[0],
            $eventsToSend[1],
            $eventsToSend[1],
            $eventsToSend[2],
            $eventsToSend[2]
        ];

        $listenedEvents = [];

        $listener = new ClosureListener(function (EventInterface $event) use(&$listenedEvents) {
            $listenedEvents[] = $event;
        });

        $compositeListener = new CompositeListener([
            $listener,
            $listener
        ]);

        foreach ($eventsToSend as $event) {
            $compositeListener->listen($event);
        }

        // check that all sent events are listened.
        $this->assertSame($requredListenedEvents, $listenedEvents);
    }
}
