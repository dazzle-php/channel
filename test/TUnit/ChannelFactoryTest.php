<?php

namespace Dazzle\Channel\Test\TUnit;

use Dazzle\Channel\Encoder\Encoder;
use Dazzle\Channel\Model\ModelFactory;
use Dazzle\Channel\Router\RouterComposite;
use Dazzle\Channel\Channel;
use Dazzle\Channel\ChannelComposite;
use Dazzle\Channel\ChannelFactory;

use Dazzle\Loop\Loop;
use Dazzle\Channel\Test\TUnit;

class ChannelFactoryTest extends TUnit
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ModelFactory
     */
    private $model;

    /**
     * @var Loop
     */
    private $loop;

    /**
     *
     */
    public function testCaseChannelFactory_HasProperParams()
    {
        $factory = $this->createChannelFactory();

        $this->assertSame($this->name, $factory->getParam('name'));
        $this->assertInstanceOf(Encoder::class, $factory->getParam('encoder'));
        $this->assertInstanceOf(RouterComposite::class, $factory->getParam('router'));
        $this->assertSame($this->loop, $factory->getParam('loop'));
    }

    /**
     *
     */
    public function testCaseChannelFactory_HasProperDefinitions()
    {
        $factory = $this->createChannelFactory();
        $classes = [
            Channel::class,
            ChannelComposite::class
        ];

        foreach ($classes as $class)
        {
            $this->assertTrue($factory->hasDefinition($class));
        }
    }

    /**
     * @return ChannelFactory
     */
    public function createChannelFactory()
    {
        $this->name  = 'name';
        $this->model = $this->getMock(ModelFactory::class, [], [], '', false);
        $this->loop  = $this->getMock(Loop::class, [], [], '', false);

        return new ChannelFactory($this->name, $this->model, $this->loop);
    }
}
