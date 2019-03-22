<?php

namespace Renatio\Support\Behaviors;

use Flash;
use Renatio\Support\Models\TicketType;

/**
 * Class TicketTypeController
 * @package Renatio\Support\Behaviors
 */
class TicketTypeController extends BaseController
{

    /**
     * @return void
     */
    protected function deleteChecked()
    {
        foreach (post('checked') as $typeId) {
            if ( ! $type = TicketType::find($typeId)) {
                continue;
            }

            $type->delete();
        }

        Flash::success(trans('renatio.support::lang.tickettype.delete_selected_success'));
    }

    /**
     * @return string
     */
    protected function getEmptyCheckMessage()
    {
        return trans('renatio.support::lang.tickettype.delete_selected_empty');
    }

}
