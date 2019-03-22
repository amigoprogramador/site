<?php

namespace Renatio\Support\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Class TicketTypes
 * @package Renatio\Support\Controllers
 */
class TicketTypes extends Controller
{

    /**
     * @var array
     */
    public $requiredPermissions = ['renatio.support.access_ticket_types'];

    /**
     * @var array
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Renatio.Support.Behaviors.TicketTypeController'
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

        BackendMenu::setContext('Renatio.Support', 'support', 'tickettypes');
    }

}
