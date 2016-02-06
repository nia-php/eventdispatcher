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
 * Interface for all event implementations.
 * Events are send to registred listeners which are able to react on a sent event.
 */
interface EventInterface
{

    /**
     * Whether propagation is stopped.
     *
     * @return bool Returns 'true' if the propagation is stopped, otherwise 'false' will be returned.
     */
    public function isPropagationStopped(): bool;

    /**
     * Stops propagination of this event in further listeners.
     */
    public function stopPropagation();
}
