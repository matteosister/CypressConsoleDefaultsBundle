<?php
/**
 * User: matteo
 * Date: 17/10/13
 * Time: 14.32
 * Just for fun...
 */

namespace Cypress\ConsoleDefaultsBundle\Tests;

use Cypress\ConsoleDefaultsBundle\Console\CommandDefault;
use Mockery as m;
use Symfony\Component\Console\Command\Command;

class CommandDefaultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CommandDefault
     */
    private $commandDefault;

    public function setUp()
    {
        $this->commandDefault = new CommandDefault('test', array('params' => array('--one', '--env=test')));
    }

    public function testIsEmpty()
    {
        $this->assertFalse($this->commandDefault->isEmpty());
        $cd = new CommandDefault('test', array('params' => array()));
        $this->assertTrue($cd->isEmpty());
    }

    public function testMatch()
    {
        $cd = new CommandDefault('/test:(.*)/', array('params' => array('--one')));
        $this->assertFalse($cd->match($this->mockCommand('')));
        $this->assertFalse($cd->match($this->mockCommand('test')));
        $this->assertTrue($cd->match($this->mockCommand('test:test')));
        $this->assertTrue($cd->match($this->mockCommand('test:test:test')));
    }

    public function testName()
    {
        $this->assertEquals('test', $this->commandDefault->getName());
    }

    public function testParams()
    {
        $this->assertEquals(array('--one', '--env=test'), $this->commandDefault->getParameters());
    }

    /**
     * @param string $name
     *
     * @return Command
     */
    private function mockCommand($name = '')
    {
        return m::mock('Symfony\Component\Console\Command\Command')
            ->shouldReceive('getName')->andReturn($name)->getMock();
    }
}
