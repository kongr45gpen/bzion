<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('bzion:config')
            ->setDescription('Greet someone')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addOption(
               'yell',
               null,
               InputOption::VALUE_NONE,
               'If set, the task will yell in uppercase letters'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getHelperSet()->get('dialog');

        $host = $dialog->ask(
            $output,
            '<question>Database Host</question>: ',
            '127.0.0.1',
            array('127.0.0.1', 'localhost')
        );

        $database = $dialog->ask(
            $output,
            '<question>Database Name</question>: ',
            'bzion',
            array('bzion', 'league')
        );

        $user = $dialog->ask(
            $output,
            '<question>Database User</question>: ',
            'bzion',
            array('bzion', 'league', 'root')
        );

        $pass = $dialog->askHiddenResponse(
            $output,
            '<question>Database Password</question>: ',
            false
        );

        $prod = $dialog->select(
            $output,
            '<question>Environment</question>: ',
            array("Development", "Production"),
            true
        );

        $name = $input->getArgument('name');
        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        if ($input->getOption('yell')) {
            $text = strtoupper($text);
        }

        $output->writeln($text);
    }
}
