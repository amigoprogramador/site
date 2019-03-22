<?php

namespace Renatio\Support\Behaviors;

use Backend\Facades\Backend;
use Backend\Facades\BackendAuth;
use Carbon\Carbon;
use Renatio\Support\Models\TicketStatus;
use Event;
use System\Classes\ModelBehavior;

/**
 * Class TicketModel
 * @package Renatio\Support\Behaviors
 */
class TicketModel extends ModelBehavior
{

    /**
     * @param \System\Classes\October\Rain\Database\Model $model
     * @throws \ApplicationException
     */
    public function __construct($model)
    {
        parent::__construct($model);
    }

    /**
     * @return void
     */
    public function close()
    {
        if ( ! $this->model->is_closed) {
            $this->model->is_closed = true;
            $this->model->save();

            Event::fire('ticket.wasClosed', [$this->model]);
        }
    }

    /**
     * @return void
     */
    public function open()
    {
        if ($this->model->is_closed) {
            $this->model->is_closed = false;
            $this->model->save();

            Event::fire('ticket.wasOpened', [$this->model]);
        }
    }

    /**
     * @return mixed
     */
    public function getOpenedCount()
    {
        return $this->model->opened()->count();
    }

    /**
     * @return mixed
     */
    public function getClosedCount()
    {
        return $this->model->closed()->count();
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return Backend::url('renatio/support/tickets/update/' . $this->model->id);
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->model->status = $status;
        $this->model->status_updated_at = Carbon::now();
        $this->model->save();
    }

    /**
     * Delete ticket attachments
     */
    public function deleteAttachments()
    {
        foreach ($this->model->attachments as $file) {
            $file->delete();
        }
    }

    /**
     * @return void
     */
    public function setDefaults()
    {
        $this->model->user = $this->model->user ?: BackendAuth::getUser()->id;
        $this->model->status = TicketStatus::first()->id;
        $this->model->status_updated_at = Carbon::now();
    }

    /**
     * @param $context
     * @return bool
     */
    public function isAllowedToUpdate($context)
    {
        return $context == 'update' && ! BackendAuth::getUser()->hasAccess('renatio.support.access_other_tickets');
    }

}
