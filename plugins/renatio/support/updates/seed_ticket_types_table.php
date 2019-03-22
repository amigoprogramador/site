<?php

namespace Renatio\Support\Updates;

use Renatio\Support\Models\TicketType;
use Seeder;

/**
 * Class SeedTicketTypesTable
 * @package Renatio\Support\Updates
 */
class SeedTicketTypesTable extends Seeder
{

    /**
     * @return void
     */
    public function run()
    {
        TicketType::create([
            'name'        => 'Technical support',
            'description' => 'Report errors or ask technical questions.'
        ]);

        TicketType::create([
            'name'        => 'Other issues',
            'description' => 'Other not mentioned earlier issues.'
        ]);
    }

}
