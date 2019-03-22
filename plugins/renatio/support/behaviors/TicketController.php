<?php

namespace Renatio\Support\Behaviors;

use Backend\Facades\BackendAuth;
use Flash;
use Renatio\Support\Models\Ticket;
use Renatio\Support\Models\TicketMessage;
use Renatio\Support\Models\TicketStatus;
use Event;

/**
 * Class TicketController
 * @package Renatio\Support\Behaviors
 */
class TicketController extends BaseController
{

    /**
     * @return mixed
     */
    public function index_onClose()
    {
        if ( ! $this->checked()) {
            Flash::error(trans('renatio.support::lang.ticket.close_selected_empty'));

            return;
        }

        $this->closeChecked();

        return $this->controller->listRefresh();
    }

    /**
     * @param $recordId
     * @return array
     * @throws \SystemException
     */
    public function onSendReply($recordId)
    {
        $ticket = Ticket::with(['messages.user', 'user'])->findOrFail($recordId);
        $message = $this->createMessage($ticket);

        Event::fire('ticket.newReply', [$ticket]);

        Flash::success(trans('renatio.support::lang.message.success'));

        return ['@#messages-list' => $this->controller->makePartial('message', ['message' => $message])];
    }

    /**
     * @param $recordId
     * @return array
     * @throws \SystemException
     */
    public function update_onChangeStatus($recordId)
    {
        $ticket = $this->controller->formFindModelObject($recordId);
        $ticket->setStatus(post('status'));

        Flash::success(trans('renatio.support::lang.status.success'));

        return $this->prepareChangeStatusResponse($ticket);
    }

    /**
     * @param $recordId
     * @return mixed
     */
    public function update_onClose($recordId)
    {
        $ticket = $this->controller->formFindModelObject($recordId);
        $ticket->close();

        Flash::success(trans('renatio.support::lang.ticket.close_success'));

        return ['#close-ticket' => $this->controller->makePartial('open_btn', ['model' => $ticket])];
    }

    /**
     * @param $recordId
     * @return mixed
     */
    public function update_onOpen($recordId)
    {
        $ticket = $this->controller->formFindModelObject($recordId);
        $ticket->open();

        Flash::success(trans('renatio.support::lang.ticket.open_success'));

        return ['#close-ticket' => $this->controller->makePartial('close_btn', ['model' => $ticket])];
    }


    /**
     * @param Ticket $ticket
     * @return mixed
     */
    private function createMessage(Ticket $ticket)
    {
        $message = TicketMessage::create([
            'user'   => BackendAuth::getUser()->id,
            'ticket' => $ticket->id,
            'reply'  => post('Ticket')['reply']
        ]);

        $ticket->messages()->save($message);
        $ticket->messages->push($message);

        return $message;
    }

    /**
     * @return void
     */
    private function closeChecked()
    {
        foreach (post('checked') as $ticketId) {
            if ( ! $ticket = Ticket::find($ticketId)) {
                continue;
            }

            $ticket->close();
        }

        Flash::success(trans('renatio.support::lang.ticket.close_selected_success'));
    }

    /**
     * @param Ticket $ticket
     * @return array
     */
    protected function prepareChangeStatusResponse(Ticket $ticket)
    {
        return [
            '#change-status'  => $this->controller->makePartial('change_status_btn',
                ['model' => $ticket, 'statuses' => TicketStatus::getActiveList()]),
            '.support-status' => $this->controller->makePartial('support_status', ['model' => $ticket])
        ];
    }

    /**
     * @return void
     */
    protected function deleteChecked()
    {
        foreach (post('checked') as $ticketId) {
            if ( ! $ticket = Ticket::find($ticketId)) {
                continue;
            }

            $ticket->delete();
        }

        Flash::success(trans('renatio.support::lang.ticket.delete_selected_success'));
    }

    /**
     * @return string
     */
    protected function getEmptyCheckMessage()
    {
        return trans('renatio.support::lang.ticket.delete_selected_empty');
    }

}
