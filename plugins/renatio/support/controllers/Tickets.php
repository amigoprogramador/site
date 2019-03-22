<?php

namespace Renatio\Support\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Renatio\Support\Models\Ticket;

/**
 * Class Tickets
 * @package Renatio\Support\Controllers
 */
class Tickets extends Controller
{

    /**
     * @var array
     */
    public $requiredPermissions = ['renatio.support.access_tickets'];

    /**
     * @var array
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Renatio.Support.Behaviors.TicketController'
    ];

    /**
     * @var string
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        $this->addCss('/plugins/renatio/support/assets/css/main.css', 'Renatio.Support');
        $this->addJs('/plugins/renatio/support/assets/js/main.js', 'Renatio.Support');

        BackendMenu::setContext('Renatio.Support', 'support', 'tickets');
    }

    /**
     * @return void
     */
    public function index()
    {
        $this->vars['open'] = Ticket::getOpenedCount();
        $this->vars['closed'] = Ticket::getClosedCount();

        $this->asExtension('ListController')->index();
    }

    /**
     * @param Ticket $ticket
     * @return string
     */
    public function listInjectRowClass(Ticket $ticket)
    {
        if ($ticket->is_closed) {
            return 'strike';
        }
    }

}
