<?php

namespace Renatio\Support\Listeners;

use Illuminate\Mail\Mailer;
use Renatio\Support\Models\Settings;
use Renatio\Support\Models\Ticket;

/**
 * Class ReplyEmail
 * @package Renatio\Support\Listeners
 */
class ReplyEmail
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
        $lastMessage = $ticket->messages->last();

        $toSupport = $this->isToSupportTeam($ticket, $lastMessage);

        $toSupport ? $this->sendEmailToSupport($ticket, $lastMessage) : $this->sendMailToOwner($ticket, $lastMessage);
    }

    /**
     * @param Ticket $ticket
     * @param $lastMessage
     */
    private function sendEmailToSupport(Ticket $ticket, $lastMessage)
    {
        foreach ($this->settings->support_team as $member) {
            $data = [
                'name'   => $member['name'],
                'ticket' => $ticket,
                'reply'  => $lastMessage->reply,
                'url'    => $ticket->getUrl(),
            ];

            $this->mailer->queue('renatio.support::mail.new_reply', $data, function ($message) use ($member) {
                $message->to($member['email'], $member['name']);
            });
        }
    }

    /**
     * @param Ticket $ticket
     * @param $lastMessage
     */
    private function sendMailToOwner(Ticket $ticket, $lastMessage)
    {
        $email = $ticket->user->email;
        $name = $ticket->user->full_name;

        $data = [
            'name'   => $name,
            'ticket' => $ticket,
            'reply'  => $lastMessage->reply,
            'url'    => $ticket->getUrl(),
        ];

        $this->mailer->queue('renatio.support::mail.new_reply', $data, function ($message) use ($email, $name) {
            $message->to($email, $name);
        });
    }

    /**
     * @param Ticket $ticket
     * @param $lastMessage
     * @return bool
     */
    protected function isToSupportTeam(Ticket $ticket, $lastMessage)
    {
        return $ticket->user_id == $lastMessage->user_id;
    }

}
