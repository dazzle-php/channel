<?php

namespace Dazzle\Channel\Model;

use Dazzle\Channel\Model\Null\NullModel;
use Dazzle\Loop\LoopInterface;
use Dazzle\Util\Factory\Factory;

class ModelFactory extends Factory implements ModelFactoryInterface
{
    /**
     * @param string $name
     * @param LoopInterface $loop
     */
    public function __construct($name, LoopInterface $loop)
    {
        parent::__construct();

        $factory = $this;
        $factory
            ->bindParam('name', $name)
            ->bindParam('loop', $loop)
        ;
        $factory
            ->define(NullModel::class, function($config = []) {
                return new NullModel();
            })
        ;
    }
}
