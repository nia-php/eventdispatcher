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

/**
 * Interface for all composite listener implementations.
 * Composite listeners are used to combine multiple listeners.
 */
interface CompositeListenerInterface extends ListenerInterface
{

    /**
     * Adds a listener.
     *
     * @param ListenerInterface $listener
     *            The listener to add.
     * @return CompositeListenerInterface Reference to this instance.
     */
    public function addListener(ListenerInterface $listener): CompositeListenerInterface;

    /**
     * Returns a list with all assigned listeners.
     *
     * @return ListenerInterface[] List with all assigned listeners.
     */
    public function getListeners(): array;

    /**
     * Removes a listener.
     *
     *
     * @param ListenerInterface $listener
     *            The listener to remove.
     * @return CompositeListenerInterface Reference to this instance.
     */
    public function removeListener(ListenerInterface $listener): CompositeListenerInterface;
}
