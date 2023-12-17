<?php

// src/Command/UptimeMonitorCommand.php

namespace App\Command;

use App\Entity\Watcher;
use App\Message\CheckUrl;
use App\Repository\WatcherRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'app:uptime-monitor')]
class UptimeMonitorCommand extends Command
{

    public function __construct(
        private MessageBusInterface $bus,
        private WatcherRepository $watcherRepository
    )
    {
        parent::__construct();

        $this->bus = $bus;

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Your uptime monitoring logic goes here
        $watchers = $this->watcherRepository->findAll();

        foreach ($watchers as $watcher) {
            if(!$watcher instanceof Watcher){
                throw new \LogicException("Wrong watcher type");
            }

            $this->bus->dispatch(new CheckUrl($watcher));
        }

        return Command::SUCCESS;
    }
}
