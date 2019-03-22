<?php

namespace Renatio\Support\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Renatio\Support\Models\Ticket;

/**
 * Class TicketMessages
 * @package Renatio\Support\FormWidgets
 */
class TicketMessages extends FormWidgetBase
{

    /**
     * @var string
     */
    protected $defaultAlias = 'renatio_support_ticket_messages';

    /**
     * @inheritdoc
     */
    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('ticketmessages');
    }

    /**
     * @return void
     */
    public function prepareVars()
    {
        $this->vars['ticket'] = Ticket::with(['messages.user', 'user'])->find($this->model->id);
    }

    /**
     * @inheritdoc
     */
    public function loadAssets()
    {
        $this->addCss('css/ticketmessages.css', 'Renatio.Support');
        $this->addJs('js/ticketmessages.js', 'Renatio.Support');
    }

}
