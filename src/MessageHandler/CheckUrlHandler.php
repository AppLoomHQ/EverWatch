<?php

namespace App\MessageHandler;

use App\Message\CheckUrl;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CheckUrlHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {

    }
    public function __invoke(CheckUrl $message)
    {
        $id = $message->getWatcher()->getId();
        $client = HttpClient::create();
        $watcher = $this->entityManager->find('App\\Entity\\Watcher', $id);
        // Your HTTP request logic goes here
        $response = $client->request('GET', $watcher->getLink());

        // if ($response->getStatusCode() !== 200) {
        //     $watcher->setStatus($response->getStatusCode());
        //     $this->entityManager->flush();
        // }


        $watcher->setStatus($response->getStatusCode());

        $this->entityManager->flush();
    }
}
