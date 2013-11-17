<?php
/**
 * User: matteo
 * Date: 26/09/13
 * Time: 23.25
 * Just for fun...
 */


namespace Cypress\ConsoleDefaultsBundle\Console;

use Symfony\Component\Console\Command\Command;

/**
 * Class CommandDefaults
 */
class CommandDefaults
{
    private $defaults;

    /**
     * class constructor
     *
     * @param array $configs
     */
    public function __construct($configs)
    {
        $this->defaults = array();
        foreach ($configs as $command => $defaults) {
            $this->defaults[] = new CommandDefault($command, $defaults);
        }
    }

    /**
     * @param Command $command
     *
     * @return bool
     */
    public function hasDefaults(Command $command)
    {
        return null !== $this->getDefaults($command);
    }

    public function getDefaults(Command $command)
    {
        /** @var CommandDefault $default */
        foreach ($this->defaults as $default) {
            if ($default->match($command)) {
                return $default;
            }
        }

        return null;
    }
}
