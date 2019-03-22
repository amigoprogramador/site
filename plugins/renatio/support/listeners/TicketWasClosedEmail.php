<?php

namespace Renatio\Support\Listeners;

use Illuminate\Mail\Mailer;
use Renatio\Support\Models\Ticket;

/**
 * Class TicketWasClosedEmail
 * @package Renatio\Support\Listeners
 */
class TicketWasClosedEmail
{

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Ticket $ticket
     */
    public function handle(Ticket $ticket)
    {
        $email = $ticket->user->email;
        $name = $ticket->user->full_name;

        $data = [
            'name'   => $name,
            'ticket' => $ticket,
            'url'    => $ticket->getUrl(),
        ];

        $this->mailer->queue('renatio.support::mail.ticket_closed', $data, function ($message) use ($email, $name) {
            $message->to($email, $name);
        });
    }

}
