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
use Nia\EventDispatcher\Event\EventTrait;

/**
 * Unit test for \Nia\EventDispatcher\Event\EventTrait.
 */
class EventTraitTest extends PHPUnit_Framework_TestCase
{

    /**
     * @covers \Nia\EventDispatcher\Event\EventTrait
     */
    public function testPropagationStopped()
    {
        $mock = $this->getMockForTrait(EventTrait::class);

        // test init value.
        $this->assertSame(false, $mock->isPropagationStopped());

        // test first stop.
        $mock->stopPropagation();
        $this->assertSame(true, $mock->isPropagationStopped());

        // test double stop.
        $mock->stopPropagation();
        $this->assertSame(true, $mock->isPropagationStopped());
    }
}
