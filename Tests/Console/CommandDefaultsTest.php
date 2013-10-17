<?php
/**
 * User: matteo
 * Date: 17/10/13
 * Time: 14.32
 * Just for fun...
 */

namespace Cypress\ConsoleDefaultsBundle\Tests;

use Cypress\ConsoleDefaultsBundle\Console\CommandDefault;
use Cypress\ConsoleDefaultsBundle\Console\CommandDefaults;
use Mockery as m;
use Symfony\Component\Console\Command\Command;

class CommandDefaultsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDefaults()
    {
        $commandDefaults = new CommandDefaults(array('test' => array('params' => array('-q'))));
        $this->assertNull($commandDefaults->getDefaults($this->mockCommand('not-present')));
        $this->assertInstanceOf(
            'Cypress\ConsoleDefaultsBundle\Console\CommandDefault',
            $commandDefaults->getDefaults($this->mockCommand('test'))
        );
    }

    /**
     * @param $name
     *
     * @return Command
     */
    private function mockCommand($name)
    {
        return m::mock('Symfony\Component\Console\Command\Command')
            ->shouldReceive('getName')->andReturn($name)->getMock();
    }
}
