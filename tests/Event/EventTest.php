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
namespace Test\Nia\EventDispatcher\Event;

use PHPUnit_Framework_TestCase;
use Nia\EventDispatcher\Event\Event;

/**
 * Unit test for \Nia\EventDispatcher\Event\Event.
 */
class EventTest extends PHPUnit_Framework_TestCase
{

    /**
     * @covers \Nia\EventDispatcher\Event\Event
     */
    public function testPropagationStopped()
    {
        $event = new Event();

        // test init value.
        $this->assertSame(false, $event->isPropagationStopped());

        // test first stop.
        $event->stopPropagation();
        $this->assertSame(true, $event->isPropagationStopped());

        // test double stop.
        $event->stopPropagation();
        $this->assertSame(true, $event->isPropagationStopped());
    }
}
