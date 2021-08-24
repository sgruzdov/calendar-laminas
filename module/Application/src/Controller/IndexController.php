<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\Service\DateManager;
use Laminas\View\Model\JsonModel;
use Application\Service\ClientManager;
use Application\Service\DbManager;
use Laminas\View\Renderer\PhpRenderer;

class IndexController extends AbstractActionController
{
    private DateManager $dateManager;
    private ClientManager $clientManager;
    private DbManager $dbManager;
    private PhpRenderer $phpRenderer;

    /**
     * IndexController constructor.
     * @param DateManager $dateManager
     * @param ClientManager $clientManager
     * @param DbManager $dbManager
     * @param PhpRenderer $phpRenderer
     */
    public function __construct(DateManager $dateManager, ClientManager $clientManager, DbManager $dbManager, PhpRenderer $phpRenderer)
    {
        $this->dateManager = $dateManager;
        $this->clientManager = $clientManager;
        $this->dbManager = $dbManager;
        $this->phpRenderer = $phpRenderer;
    }

    /**
     * @return JsonModel|ViewModel
     */
    public function indexAction()
    {
        $events = $this->dateManager->getData();

        if ($this->getRequest()->isPost()) {
            $data = json_decode($this->getRequest()->getContent());

            $this->dateManager->setNumberWeek($data->week);
            $this->dateManager->setYear($data->year);

            $events = $this->dateManager->getData();

            $htmlViewPart = new ViewModel([
                'events' => $events,
                'dateManager' => $this->dateManager,
            ]);
            $htmlViewPart->setTerminal(true)->setTemplate('application/_partials/events');
            $htmlOutput = $this->phpRenderer->render($htmlViewPart);

            return new JsonModel([
                'html' => $htmlOutput,
                'prevDate' => $this->dateManager->getPrevDate(),
                'nextDate' => $this->dateManager->getNextDate(),
                'title' => $this->dateManager->getGap(),
            ]);
        }

        return new ViewModel([
            'dateManager' => $this->dateManager,
            'events' => $events,
        ]);
    }

    /**
     * @return JsonModel|ViewModel
     */
    public function singleEventAction()
    {
        $eventId = $this->getRequest()->getQuery()['id'];
        if ($eventId) {
            $event = $this->dbManager->getEvent((int) $eventId);

            return new JsonModel([
                'event' => $event->getAll()
            ]);
        } else {
            return $this->getResponse()->setStatusCode(404);
        }
    }

    /**
     * @return JsonModel|ViewModel
     */
    public function addClientAction()
    {
        $req = json_decode($this->getRequest()->getContent());
        $event = $this->dbManager->getEvent((int) $req->id);

        if (!$event) {
            $this->getResponse()->setStatusCode(404);
        }

        $this->clientManager->addClient($event, $req);

        return new JsonModel();
    }
}
