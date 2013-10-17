<?php
/**
 * User: matteo
 * Date: 26/09/13
 * Time: 23.25
 * Just for fun...
 */


namespace Cypress\ConsoleDefaultsBundle\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class CommandDefaults
 */
class CommandDefaults
{
    private $defaults;

    public function __construct($configs)
    {
        $this->defaults = array();
        foreach ($configs as $command => $defaults) {
            $this->defaults[] = new CommandDefault($command, $defaults);
        }
    }

    public function hasDefaults(Command $command)
    {
        return null !== $this->getDefaults($command);
    }

    public function getDefaults(Command $command)
    {
        /** @var CommandDefault $default */
        foreach ($this->defaults as $default) {
            if ($default->getName() === $command->getName() && !$default->isEmpty()) {
                return $default;
            }
        }

        return null;
    }
}
