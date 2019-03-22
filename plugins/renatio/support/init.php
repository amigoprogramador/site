<?php

Event::listen('ticket.afterCreate', 'Renatio\Support\Listeners\EmailSupportTeam');
Event::listen('ticket.wasClosed', 'Renatio\Support\Listeners\TicketWasClosedEmail');
Event::listen('ticket.newReply', 'Renatio\Support\Listeners\ReplyEmail');