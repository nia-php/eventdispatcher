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
 * Default composite listener implementation.
 */
class CompositeListener implements CompositeListenerInterface
{

    /**
     * List with assigned listeners.
     *
     * @var ListenerInterface[]
     */
    private $listeners = [];

    /**
     * Constructor.
     *
     * @param ListenerInterface[] $listeners
     *            List with listeners.
     */
    public function __construct(array $listeners = [])
    {
        foreach ($listeners as $listener) {
            $this->addListener($listener);
        }
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\Listener\CompositeListenerInterface::addListener($listener)
     */
    public function addListener(ListenerInterface $listener): CompositeListenerInterface
    {
        $this->listeners[] = $listener;

        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\Listener\CompositeListenerInterface::getListeners()
     */
    public function getListeners(): array
    {
        return $this->listeners;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\Listener\CompositeListenerInterface::removeListener($listener)
     */
    public function removeListener(ListenerInterface $listener): CompositeListenerInterface
    {
        $listeners = array_reverse($this->listeners);

        $index = array_search($listener, $listeners, true);

        if ($index !== false) {
            unset($listeners[$index]);

            $this->listeners = array_reverse($listeners);
        }

        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\Listener\ListenerInterface::listen($event)
     */
    public function listen(EventInterface $event)
    {
        foreach ($this->listeners as $listener) {
            $listener->listen($event);
        }
    }
}
