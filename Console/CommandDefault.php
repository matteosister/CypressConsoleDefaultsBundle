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
        foreach ($defaults['params'] as $param) {
            if (!empty($param)) {
                $this->params[] = $param;
            }
        }
    }

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
