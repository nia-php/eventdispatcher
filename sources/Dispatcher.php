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
use Nia\EventDispatcher\Listener\CompositeListenerInterface;
use Nia\EventDispatcher\Listener\ListenerInterface;
use Nia\EventDispatcher\Provider\ProviderInterface;
use Nia\EventDispatcher\Listener\CompositeListener;

/**
 * Default event dispatcher implementation.
 */
class Dispatcher implements DispatcherInterface
{

    /**
     * Map with event names and listeners.
     *
     * @var CompositeListenerInterface[]
     */
    private $listeners = [];

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\DispatcherInterface::registerListener($eventName, $listener)
     */
    public function registerListener(string $eventName, ListenerInterface $listener): DispatcherInterface
    {
        if (! $this->hasListeners($eventName)) {
            $this->listeners[$eventName] = new CompositeListener();
        }

        $this->listeners[$eventName]->addListener($listener);

        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\DispatcherInterface::registerProvider($provider)
     */
    public function registerProvider(ProviderInterface $provider): DispatcherInterface
    {
        $provider->register($this);

        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\DispatcherInterface::removeListener($eventName, $listener)
     */
    public function removeListener(string $eventName, ListenerInterface $listener): DispatcherInterface
    {
        if ($this->hasListeners($eventName)) {
            $this->listeners[$eventName]->removeListener($listener);

            // remove composite if no more listeners are registred.
            if (count($this->listeners[$eventName]->getListeners()) !== 0) {
                unset($this->listeners[$eventName]);
            }
        }

        return $this;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\DispatcherInterface::hasListeners($eventName)
     */
    public function hasListeners(string $eventName): bool
    {
        return array_key_exists($eventName, $this->listeners);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\DispatcherInterface::getListeners($eventName)
     */
    public function getListeners(string $eventName): array
    {
        if ($this->hasListeners($eventName)) {
            return $this->listeners[$eventName]->getListeners();
        }

        return [];
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\DispatcherInterface::dispatch($eventName, $event)
     */
    public function dispatch(string $eventName, EventInterface $event): DispatcherInterface
    {
        if ($this->hasListeners($eventName)) {
            $this->listeners[$eventName]->listen($event);
        }

        return $this;
    }
}
