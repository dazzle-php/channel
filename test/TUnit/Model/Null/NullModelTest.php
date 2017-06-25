<?php

namespace Dazzle\Channel\Test\TUnit\Model\Null;

use Dazzle\Channel\Model\Null\NullModel;
use Dazzle\Channel\Test\TUnit;

class NullModelTest extends TUnit
{
    /**
     *
     */
    public function testApiStart_ReturnsTrue()
    {
        $model = $this->createModel();
        $this->assertTrue($model->start());
    }

    /**
     *
     */
    public function testApiStop_ReturnsTrue()
    {
        $model = $this->createModel();
        $this->assertTrue($model->stop());
    }

    /**
     *
     */
    public function testApiUnicast_ReturnsTrue()
    {
        $model = $this->createModel();
        $this->assertTrue($model->unicast($id = 'id', $text = 'text', $flags = 'flags'));
    }

    /**
     *
     */
    public function testApiBroadcast_ReturnsEmptyArray()
    {
        $model = $this->createModel();
        $this->assertSame([], $model->broadcast($text = 'text'));
    }

    /**
     *
     */
    public function testApiIsStarted_ReturnsFalse()
    {
        $model = $this->createModel();
        $this->assertFalse($model->isStarted());
    }

    /**
     *
     */
    public function testApiIsStopped_ReturnsTrue()
    {
        $model = $this->createModel();
        $this->assertTrue($model->isStopped());
    }

    /**
     *
     */
    public function testApiIsConnected()
    {
        $model = $this->createModel();
        $this->assertFalse($model->isConnected($id = 'id'));
    }

    /**
     *
     */
    public function testApiGetConnected()
    {
        $model = $this->createModel();
        $this->assertSame([], $model->getConnected());
    }

    /**
     *
     */
    public function createModel()
    {
        return new NullModel();
    }
}
