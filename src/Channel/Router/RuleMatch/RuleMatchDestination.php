<?php

namespace Dazzle\Channel\Router\RuleMatch;

use Dazzle\Channel\Protocol\ProtocolInterface;
use Dazzle\Util\Support\StringSupport;

class RuleMatchDestination
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     *
     */
    public function __destruct()
    {
        unset($this->name);
    }

    /**
     * @param string $name
     * @param ProtocolInterface $protocol
     * @return bool
     */
    public function __invoke($name, ProtocolInterface $protocol)
    {
        return StringSupport::match($this->name, $protocol->getDestination());
    }
}
