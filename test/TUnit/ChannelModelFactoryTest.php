<?php

namespace Dazzle\Channel\Test\TUnit;

use Dazzle\Channel\Model\Null\NullModel;
use Dazzle\Channel\ChannelModelFactory;
use Dazzle\Loop\Loop;
use Dazzle\Channel\Test\TUnit;

class ChannelModelFactoryTest extends TUnit
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Loop
     */
    private $loop;

    /**
     *
     */
    public function testCaseChannelModelFactory_HasProperParams()
    {
        $factory = $this->createChannelModelFactory();

        $this->assertSame($this->name, $factory->getParam('name'));
        $this->assertSame($this->loop, $factory->getParam('loop'));
    }

    /**
     *
     */
    public function testCaseChannelModelFactory_HasProperDefinitions()
    {
        $factory = $this->createChannelModelFactory();
        $classes = [
            NullModel::class,
        ];

        foreach ($classes as $class)
        {
            $this->assertTrue($factory->hasDefinition($class));
        }
    }

    /**
     * @return ChannelModelFactory
     */
    public function createChannelModelFactory()
    {
        $this->name = 'name';
        $this->loop = $this->getMock(Loop::class, [], [], '', false);

        return new ChannelModelFactory($this->name, $this->loop);
    }
}
