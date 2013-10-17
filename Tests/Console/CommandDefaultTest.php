<?php
/**
 * User: matteo
 * Date: 17/10/13
 * Time: 14.32
 * Just for fun...
 */

namespace Cypress\ConsoleDefaultsBundle\Tests;

use Cypress\ConsoleDefaultsBundle\Console\CommandDefault;

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
} 