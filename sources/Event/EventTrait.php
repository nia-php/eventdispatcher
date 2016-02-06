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
namespace Nia\EventDispatcher\Event;

/**
 * Trait for common methods and attributes for the default event implementation.
 */
trait EventTrait
{

    /**
     * Whether propagation is stopped.
     *
     * @var bool
     */
    private $propagationStopped = false;

    /**
     * Whether propagation is stopped.
     *
     * @return bool Returns 'true' if the propagation is stopped, otherwise 'false' will be returned.
     */
    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    /**
     * Stops propagination of this event in further listeners.
     */
    public function stopPropagation()
    {
        $this->propagationStopped = true;
    }
}
