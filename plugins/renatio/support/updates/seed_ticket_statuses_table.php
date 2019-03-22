<?php

namespace Renatio\Support\Updates;

use Renatio\Support\Models\TicketStatus;
use Seeder;

/**
 * Class SeedTicketStatusesTable
 * @package Renatio\Support\Updates
 */
class SeedTicketStatusesTable extends Seeder
{

    /**
     * @return void
     */
    public function run()
    {
        $statuses = ['New', 'Inprogress', 'Fixed', 'Client', 'Question'];

        foreach ($statuses as $status) {
            TicketStatus::create([
                'name' => $status
            ]);
        }
    }

}
