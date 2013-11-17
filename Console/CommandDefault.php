<?php
/**
 * User: matteo
 * Date: 26/09/13
 * Time: 23.30
 * Just for fun...
 */


namespace Cypress\ConsoleDefaultsBundle\Console;

use Symfony\Component\Console\Command\Command;

/**
 * Class CommandDefault
 *
 * defaults parameters and options for a command identified by "name"
 */
class CommandDefault
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $params;

    /**
     * @param string $name
     * @param array  $defaults
     */
    public function __construct($name, array $defaults)
    {
        $this->name = $name;
        foreach ($defaults['params'] as $param) {
            if (!empty($param)) {
                $this->params[] = $param;
            }
        }
    }

    /**
     * @param \Symfony\Component\Console\Command\Command $command
     *
     * @return bool
     */
    public function match(Command $command)
    {
        if ($this->isEmpty()) {
            return false;
        }
        if ($this->isRegExp()) {
            return 1 === preg_match($this->getName(), $command->getName());
        }
        return $command->getName() === $this->getName();
    }

    public function isRegExp()
    {
        return substr($this->getName(), 0, 1) === '/';
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return 0 === count($this->params);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get Arguments
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->params;
    }
}
