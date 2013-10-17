<?php
/**
 * User: matteo
 * Date: 17/10/13
 * Time: 15.40
 * Just for fun...
 */

namespace Cypress\ConsoleDefaultsBundle\Tests\Listener;

use Cypress\ConsoleDefaultsBundle\Console\CommandDefaults;
use Cypress\ConsoleDefaultsBundle\Listener\ConsoleListener;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Mockery as m;
use Symfony\Component\Console\Input\ArgvInput;

class ConsoleListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     *
     * @param $configs
     * @param $expected
     */
    public function testOnConsoleCommand($configs, $expected)
    {
        $listener = new ConsoleListener(new CommandDefaults($configs));
        $input = new ArgvInput(array());
        $event = $this->mockEvent('test');
        $event->shouldReceive('getInput')->andReturn($input)->getMock();
        $listener->onConsoleCommand($event);
        $this->assertEquals($expected, $this->getInputTokens($input));
    }

    public function provider()
    {
        return array(
            array(
                array('test' => array('params' => array())),
                array()
            ),
            array(
                array('test' => array('params' => array('-w'))),
                array('-w')
            ),
            array(
                array('test' => array('params' => array('-w', ''))),
                array('-w')
            ),
            array(
                array('test' => array('params' => array('-w', null))),
                array('-w')
            ),
            array(
                array('test' => array('params' => array('-w yes'))),
                array('-w yes')
            )
        );
    }

    private function getInputTokens($input)
    {
        $refl = new \ReflectionObject($input);
        $tokensProp = $refl->getProperty('tokens');
        $tokensProp->setAccessible(true);
        return $tokensProp->getValue($input);
    }

    public function mockEvent($commandName)
    {
        $output = m::mock('Symfony\Component\Console\Output\OutputInterface')
            ->shouldReceive('writeln')->andReturn()->getMock();
        return m::mock('Symfony\Component\Console\Event\ConsoleCommandEvent')
            ->shouldReceive('getCommand')->andReturn($this->mockCommand($commandName))->getMock()
            ->shouldReceive('getOutput')->andReturn($output)->getMock();
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

    public function tearDown()
    {
        m::close();
    }
}
