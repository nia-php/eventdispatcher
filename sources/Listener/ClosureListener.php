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

use Closure;
use Nia\EventDispatcher\Event\EventInterface;

/**
 * Listener implementation using a closure.
 */
class ClosureListener implements ListenerInterface
{

    /**
     * The listening closure.
     *
     * @var Closure
     */
    private $closure = null;

    /**
     * Constructor.
     *
     * @param Closure $closure
     *            The listening closure.
     */
    public function __construct(Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Nia\EventDispatcher\Listener\ListenerInterface::listen($event)
     */
    public function listen(EventInterface $event)
    {
        $closure = $this->closure;
        $closure($event);
    }
}
