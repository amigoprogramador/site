<?php

namespace Renatio\Support\Updates;

use Seeder;
use Laracasts\TestDummy\Factory as TestDummy;

/**
 * Class SeedDataTable
 * @package Renatio\Support\Updates
 */
class SeedDataTable extends Seeder
{

    const TICKETS = 10;
    const TICKET_MESSAGES = 5;

    public function __construct()
    {
        TestDummy::$factoriesPath = 'plugins/renatio/support/tests/factories';
    }

    /**
     * @return void
     */
    public function run()
    {
        $tickets = TestDummy::times(self::TICKETS)->create('Renatio\Support\Models\Ticket');

        foreach ($tickets as $ticket) {
            TestDummy::times(self::TICKET_MESSAGES)->create('Renatio\Support\Models\TicketMessage',
                ['ticket' => $ticket->id]);
        }
    }

}