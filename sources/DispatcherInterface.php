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
namespace Nia\EventDispatcher;

use Nia\EventDispatcher\Event\EventInterface;
use Nia\EventDispatcher\Listener\ListenerInterface;
use Nia\EventDispatcher\Provider\ProviderInterface;

/**
 * Interface for all event dispatcher implementations.
 */
interface DispatcherInterface
{

    /**
     * Registers a listener implementation on an event. If the same listener is already registred on the event it will be registered twice.
     *
     * @param string $eventName
     *            The event name to listen for.
     * @param ListenerInterface $listener
     *            The listener to register.
     * @return DispatcherInterface Reference to this instance.
     */
    public function registerListener(string $eventName, ListenerInterface $listener): DispatcherInterface;

    /**
     * Registers a listener provider.
     *
     * @param ProviderInterface $provider
     *            The listener provider to register.
     * @return DispatcherInterface Reference to this instance.
     */
    public function registerProvider(ProviderInterface $provider): DispatcherInterface;

    /**
     * Removes a listener.
     *
     * @param string $eventName
     *            Name of the event.
     * @param ListenerInterface $listener
     *            The listener to remove.
     * @return DispatcherInterface Reference to this instance.
     */
    public function removeListener(string $eventName, ListenerInterface $listener): DispatcherInterface;

    /**
     * Checks whether listeners are registred for an event name.
     *
     * @param string $eventName
     *            Name of the event.
     * @return bool Returns 'true' if one or more listeners registred for the event name, otherwise 'false' will be returned.
     */
    public function hasListeners(string $eventName): bool;

    /**
     * Returns a list with all assigned listeners for an event name.
     *
     * @param string $eventName
     *            Name of the event.
     * @return ListenerInterface List with all assigned listeners for an event name.
     */
    public function getListeners(string $eventName): array;

    /**
     * Dispatches an event to all listening listeners.
     *
     * @param string $eventName
     *            Name of the event.
     * @param EventInterface $event
     *            The event.
     * @return DispatcherInterface Reference to this instance.
     */
    public function dispatch(string $eventName, EventInterface $event): DispatcherInterface;
}
