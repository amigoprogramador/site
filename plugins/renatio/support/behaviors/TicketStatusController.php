<?php

namespace Renatio\Support\Behaviors;

use Flash;
use Renatio\Support\Models\TicketStatus;

/**
 * Class TicketStatusController
 * @package Renatio\Support\Behaviors
 */
class TicketStatusController extends BaseController
{

    /**
     * @return void
     */
    protected function deleteChecked()
    {
        foreach (post('checked') as $statusId) {
            if ( ! $status = TicketStatus::find($statusId)) {
                continue;
            }

            $status->delete();
        }

        Flash::success(trans('renatio.support::lang.ticketstatus.delete_selected_success'));
    }

    /**
     * @return string
     */
    protected function getEmptyCheckMessage()
    {
        return trans('renatio.support::lang.ticketstatus.delete_selected_empty');
    }

}
