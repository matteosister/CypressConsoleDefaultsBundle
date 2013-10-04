<?php
/**
 * User: matteo
 * Date: 26/09/13
 * Time: 23.41
 * Just for fun...
 */

namespace Cypress\ConsoleDefaultsBundle\Listener;

use Cypress\ConsoleDefaultsBundle\Console\CommandDefaults;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;

/**
 * Class ConsoleListener
 */
class ConsoleListener
{
    /**
     * @var \Cypress\ConsoleDefaultsBundle\Console\CommandDefaults
     */
    private $commandDefaults;

    /**
     * @param CommandDefaults $commandDefaults
     */
    public function __construct(CommandDefaults $commandDefaults)
    {
        $this->commandDefaults = $commandDefaults;
    }

    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        if ($this->commandDefaults->hasDefaults($event->getCommand())) {
            $arrayInput = new ArrayInput(array_merge(array(
                    'command' => $event->getCommand()->getName()
                ),
                $this->commandDefaults->getDefaults($event->getCommand())->getArrayArguments(),
                $this->commandDefaults->getDefaults($event->getCommand())->getArrayOptions()
            ));
            $event->getCommand()->run($arrayInput, $event->getOutput());
            die;
        }
    }
} 