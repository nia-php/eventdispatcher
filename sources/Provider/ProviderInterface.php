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
namespace Nia\EventDispatcher\Provider;

use Nia\EventDispatcher\DispatcherInterface;

/**
 * Interface for all listener provider implementations.
 * Listener providers can be registred to a dispatcher implementation and fills up the dispatcher with one or more listeners.
 */
interface ProviderInterface
{

    /**
     * Registers this provider to the passed dispatcher.
     *
     *
     * @param DispatcherInterface $dispatcher
     *            The dispatcher.
     */
    public function register(DispatcherInterface $dispatcher);
}
