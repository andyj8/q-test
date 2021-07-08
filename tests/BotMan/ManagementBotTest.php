<?php

namespace Tests\BotMan;

use App\Services\InstanceManagement;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ManagementBotTest extends TestCase
{
    public function testList()
    {
        $data = [['DBInstanceIdentifier' => 'db-1']];

        $this->instance(
            InstanceManagement::class,
            Mockery::mock(InstanceManagement::class, function (MockInterface $mock) use ($data) {
                $mock->shouldReceive('list')->andReturn($data);
            })
        );

        $expected = view('list', ['instances' => $data])->render();
        $this->bot->receives('list')->assertReply($expected);
    }

    public function testStatus()
    {
        $data = [
            'DBInstanceIdentifier' => 'a',
            'Engine' => 'b',
            'DBInstanceStatus' => 'c',
        ];

        $this->instance(
            InstanceManagement::class,
            Mockery::mock(InstanceManagement::class, function (MockInterface $mock) use ($data) {
                $mock->shouldReceive('status')->with('id')->andReturn($data);
            })
        );

        $expected = view('status', ['instance' => $data])->render();
        $this->bot->receives('status id')->assertReply($expected);
    }

    public function testCreate()
    {
        $this->instance(
            InstanceManagement::class,
            Mockery::mock(InstanceManagement::class, function (MockInterface $mock) {
                $mock->shouldReceive('create')->with('id', 'class', 'engine')->once()->andReturn('ok');
            })
        );

        $this->bot->receives('create id class engine')->assertReply('ok');
    }

    public function testDelete()
    {
        $this->instance(
            InstanceManagement::class,
            Mockery::mock(InstanceManagement::class, function (MockInterface $mock) {
                $mock->shouldReceive('delete')->with('id')->once()->andReturn('result');
            })
        );

        $this->bot->receives('delete id')->assertReply('result');
    }

    public function testStart()
    {
        $this->instance(
            InstanceManagement::class,
            Mockery::mock(InstanceManagement::class, function (MockInterface $mock) {
                $mock->shouldReceive('start')->with('id')->once()->andReturn('result');
            })
        );

        $this->bot->receives('start id')->assertReply('result');
    }

    public function testStop()
    {
        $this->instance(
            InstanceManagement::class,
            Mockery::mock(InstanceManagement::class, function (MockInterface $mock) {
                $mock->shouldReceive('stop')->with('id')->once()->andReturn('result');
            })
        );

        $this->bot->receives('stop id')->assertReply('result');
    }

    public function testHelp()
    {
        $this->bot
            ->receives('help')
            ->assertReply(view('help')->render());
    }
}
