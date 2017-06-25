<?php

namespace Dazzle\Channel\Test\TUnit\Model;

use Dazzle\Channel\Model\Null\NullModel;
use Dazzle\Channel\Model\ModelFactory;
use Dazzle\Channel\Model\ModelFactoryInterface;
use Dazzle\Loop\Loop;
use Dazzle\Channel\Test\TUnit;

class ModelFactoryTest extends TUnit
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
        $factory = $this->createModelFactory();

        $this->assertSame($this->name, $factory->getParam('name'));
        $this->assertSame($this->loop, $factory->getParam('loop'));
    }

    /**
     *
     */
    public function testCaseChannelModelFactory_HasProperDefinitions()
    {
        $factory = $this->createModelFactory();
        $classes = [
            NullModel::class,
        ];

        foreach ($classes as $class)
        {
            $this->assertTrue($factory->hasDefinition($class));
        }
    }

    /**
     * @return ModelFactory
     */
    public function createModelFactory()
    {
        $this->name = 'name';
        $this->loop = $this->getMock(Loop::class, [], [], '', false);

        return new ModelFactory($this->name, $this->loop);
    }
}
