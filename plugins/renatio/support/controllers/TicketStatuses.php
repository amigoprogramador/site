<?php

namespace Renatio\Support\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Class TicketStatuses
 * @package Renatio\Support\Controllers
 */
class TicketStatuses extends Controller
{

    /**
     * @var array
     */
    public $requiredPermissions = ['renatio.support.access_ticket_statuses'];

    /**
     * @var array
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Renatio.Support.Behaviors.TicketStatusController'
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

        BackendMenu::setContext('Renatio.Support', 'support', 'ticketstatuses');
    }

}
