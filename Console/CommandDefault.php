<?php
/**
 * User: matteo
 * Date: 26/09/13
 * Time: 23.30
 * Just for fun...
 */


namespace Cypress\ConsoleDefaultsBundle\Console;

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
        $this->params = array_key_exists('params', $defaults) ? $defaults['params'] : array();
    }

    public function isEmpty()
    {
        return 0 === count($this->params);
    }

    /**
     * Set Name
     *
     * @param string $name the name variable
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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

    /**
     * Get Arguments as array
     *
     * @return array
     */
    public function getArrayParameters()
    {
        $params = array();
        foreach ($this->params as $arg) {
            $params[] = $arg;
        }

        return $params;
    }
} 