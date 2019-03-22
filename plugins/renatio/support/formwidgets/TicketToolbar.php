<?php

namespace Renatio\Support\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Renatio\Support\Models\TicketStatus;

/**
 * Class TicketToolbar
 * @package Renatio\Support\FormWidgets
 */
class TicketToolbar extends FormWidgetBase
{

    /**
     * @inheritdoc
     */
    protected $defaultAlias = 'renatio_support_ticket_toolbar';

    /**
     * @inheritdoc
     */
    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('tickettoolbar');
    }

    /**
     * @return void
     */
    public function prepareVars()
    {
        $this->vars['statuses'] = TicketStatus::active()->get()->lists('name', 'id');
        $this->vars['model'] = $this->model;
    }

}
