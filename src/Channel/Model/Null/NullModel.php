<?php

namespace Dazzle\Channel\Model\Null;

use Dazzle\Channel\Model\ModelInterface;
use Dazzle\Event\BaseEventEmitter;

class NullModel extends BaseEventEmitter implements ModelInterface
{
    /**
     * @override
     * @inheritDoc
     */
    public function start($blockEvent = false)
    {
        return true;
    }

    /**
     * @override
     * @inheritDoc
     */
    public function stop($blockEvent = false)
    {
        return true;
    }

    /**
     * @override
     * @inheritDoc
     */
    public function unicast($alias, $message, $flags)
    {
        return true;
    }

    /**
     * @override
     * @inheritDoc
     */
    public function broadcast($message)
    {
        return [];
    }

    /**
     * @override
     * @inheritDoc
     */
    public function isStarted()
    {
        return false;
    }

    /**
     * @override
     * @inheritDoc
     */
    public function isStopped()
    {
        return true;
    }

    /**
     * @override
     * @inheritDoc
     */
    public function isConnected($alias)
    {
        return false;
    }

    /**
     * @override
     * @inheritDoc
     */
    public function getConnected()
    {
        return [];
    }
}
