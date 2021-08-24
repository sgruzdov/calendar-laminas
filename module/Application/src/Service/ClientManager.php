<?php

namespace Application\Service;

use Application\Entity\Client;
use Application\Entity\Event;

/**
 * Class ClientManager
 * @package Application\Service
 */
class ClientManager
{
    private DbManager $dbManager;

    /**
     * ClientManager constructor.
     * @param DbManager $dbManager
     */
    public function __construct(DbManager $dbManager)
    {
        $this->dbManager = $dbManager;
    }

    public function addClient(Event $event, object $req): void
    {
        $client = new Client();

        $client->setEvent($event);
        $client->setInitials($req->initials);
        $client->setEmail($req->email);

        $this->dbManager->saveData($client);
    }
}
