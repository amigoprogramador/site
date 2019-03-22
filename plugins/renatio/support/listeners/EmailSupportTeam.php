<?php

namespace Renatio\Support\Listeners;

use Illuminate\Mail\Mailer;
use Renatio\Support\Models\Settings;
use Renatio\Support\Models\Ticket;

/**
 * Class EmailSupportTeam
 * @package Renatio\Support\Listeners
 */
class EmailSupportTeam
{

    /**
     * @var Settings
     */
    private $settings;

    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @param Mailer $mailer
     * @param Settings $settings
     */
    public function __construct(Mailer $mailer, Settings $settings)
    {
        $this->mailer = $mailer;
        $this->settings = $settings->instance();
    }

    /**
     * @param Ticket $ticket
     */
    public function handle(Ticket $ticket)
    {
        foreach ($this->settings->support_team as $member) {
            $data = [
                'name'   => $member['name'],
                'owner'  => $ticket->user->full_name,
                'ticket' => $ticket,
                'url'    => $ticket->getUrl(),
            ];

            $this->mailer->queue('renatio.support::mail.new_ticket', $data, function ($message) use ($member) {
                $message->to($member['email'], $member['name']);
            });
        }
    }

}
