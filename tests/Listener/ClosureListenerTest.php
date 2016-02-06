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
use Nia\EventDispatcher\Listener\ClosureListener;
use Nia\EventDispatcher\Event\EventInterface;
use Nia\EventDispatcher\Event\Event;

/**
 * Unit test for \Nia\EventDispatcher\Listener\ClosureListener.
 */
class ClosureListenerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @covers \Nia\EventDispatcher\Listener\ClosureListener::listen
     */
    public function testListen()
    {
        $eventsToSend = [
            new Event(),
            new Event(),
            new Event()
        ];

        $listenedEvents = [];

        $listener = new ClosureListener(function (EventInterface $event) use(&$listenedEvents) {
            $listenedEvents[] = $event;
        });

        foreach ($eventsToSend as $event) {
            $listener->listen($event);
        }

        // check that all sent events are listened.
        $this->assertSame($eventsToSend, $listenedEvents);
    }
}
