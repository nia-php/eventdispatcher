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
namespace Nia\EventDispatcher\Listener;

use Nia\EventDispatcher\Event\EventInterface;

/**
 * Interface for all event listener implementations.
 * Listeners can be registred into an event dispatcher implementation and are invoked if a specific event is fired.
 */
interface ListenerInterface
{

    /**
     * Listens to the fired event.
     *
     * @param EventInterface $event
     *            The fired event where this listener is listening to.
     */
    public function listen(EventInterface $event);
}
