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
use Symfony\Component\Console\Output\OutputInterface;

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
            $defaults = $this->commandDefaults->getDefaults($event->getCommand())->getParameters();
            $this->alertUser($event->getOutput(), $defaults, $event->getCommand()->getName());
            $input = $event->getInput();
            $tokenReader = function ($input) {
                return $input->tokens;
            };
            $tokenReader = \Closure::bind($tokenReader, null, $input);
            $tokens = $tokenReader($input);

            $tokensWriter = function($input, $tokens) {
                $input->tokens = $tokens;
            };
            $tokensWriter = \Closure::bind($tokensWriter, null, $input);

            $newTokens = array_merge($tokens, $defaults);
            $tokensWriter($input, $newTokens);
        }
    }

    public function alertUser(OutputInterface $output, $defaults, $command)
    {
        $output->writeln(
            sprintf(
                '--- <info>ConsoleDefaultsBundle</info> You have defined some defaults for the <info>%s</info> command',
                $command
            )
        );
        $output->writeln(
            sprintf('--- proceeding with defaults: <comment>%s</comment>', implode(', ', $defaults))
        );
    }
} 