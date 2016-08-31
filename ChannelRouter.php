<?php

namespace Kraken\Channel;

class ChannelRouter implements ChannelRouterInterface
{
    /**
     * @var int
     */
    const MODE_DEFAULT = 1;

    /**
     * @var int
     */
    const MODE_ROUTER = 1;

    /**
     * @var int
     */
    const MODE_FIREWALL = 2;

    /**
     * @var ChannelRouterHandler[]
     */
    protected $rules;

    /**
     * @var int
     */
    protected $rulesPointer;

    /**
     * @var ChannelRouterHandler[]
     */
    protected $anchors;

    /**
     * @var int
     */
    protected $anchorsPointer;

    /**
     * @var int
     */
    protected $flags;

    /**
     * @param int $flags
     */
    public function __construct($flags = ChannelRouter::MODE_ROUTER)
    {
        $this->rules = [];
        $this->rulesPointer = 0;
        $this->anchors = [];
        $this->anchorsPointer = 0;
        $this->flags = $flags;
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->erase();

        unset($this->rules);
        unset($this->rulesPointer);
        unset($this->anchors);
        unset($this->anchorsPointer);
        unset($this->flags);
    }

    /**
     * @override
     * @inheritDoc
     */
    public function handle($name, ChannelProtocolInterface $protocol, $flags = 0, callable $success = null, callable $failure = null, callable $cancel = null, $timeout = 0.0)
    {
        $status = $this->flags === ChannelRouter::MODE_ROUTER;
        $handled = !$status;

        foreach ($this->rules as $handler)
        {
            if ($handler->match($name, $protocol) === true)
            {
                if ($handler->handle($name, $protocol, $flags, $success, $failure, $cancel, $timeout) === false)
                {
                    return $status;
                }

                $handled = $status;
            }
        }

        if ($handled === $status)
        {
            return $handled;
        }

        foreach ($this->anchors as $anchor)
        {
            if ($anchor->handle($name, $protocol, $flags, $success, $failure, $cancel, $timeout) === false)
            {
                return $status;
            }

            $handled = $status;
        }

        return $handled;
    }

    /**
     * @override
     * @inheritDoc
     */
    public function erase()
    {
        foreach ($this->rules as $handler)
        {
            $handler->cancel();
        }

        foreach ($this->anchors as $anchor)
        {
            $anchor->cancel();
        }

        $this->rules = [];
        $this->rulesPointer = 0;
        $this->anchors = [];
        $this->anchorsPointer = 0;
    }

    /**
     * @override
     * @inheritDoc
     */
    public function addRule(callable $matcher, callable $handler, $propagate = false, $limit = 0)
    {
        return $this->addRuleHandler(
            new ChannelRouterHandler($this, $matcher, $handler, $propagate, $limit)
        );
    }

    /**
     * @override
     * @inheritDoc
     */
    public function addAnchor(callable $handler, $propagate = false, $limit = 0)
    {
        return $this->addDefaultHandler(
            new ChannelRouterHandler($this, function() {}, $handler, $propagate, $limit)
        );
    }

    /**
     * @internal
     * @param $stack
     * @param $pointer
     */
    public function removeHandler($stack, $pointer)
    {
        unset($this->{$stack}[$pointer]);
    }

    /**
     * @param ChannelRouterHandler $handler
     * @return ChannelRouterHandler
     */
    protected function addRuleHandler(ChannelRouterHandler $handler)
    {
        $this->rules[$this->rulesPointer] = $handler;
        $handler->setPointer('handlers', $this->rulesPointer);
        $this->rulesPointer++;

        return $handler;
    }

    /**
     * @param ChannelRouterHandler $handler
     * @return ChannelRouterHandler
     */
    protected function addDefaultHandler(ChannelRouterHandler $handler)
    {
        $this->anchors[$this->anchorsPointer] = $handler;
        $handler->setPointer('anchors', $this->anchorsPointer);
        $this->anchorsPointer++;

        return $handler;
    }
}
