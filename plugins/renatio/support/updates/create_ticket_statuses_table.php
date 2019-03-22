<?php

namespace Renatio\Support\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTicketStatusesTable
 * @package Renatio\Support\Updates
 */
class CreateTicketStatusesTable extends Migration
{

    /**
     * @return void
     */
    public function up()
    {
        Schema::create('renatio_support_ticket_statuses', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 50);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renatio_support_ticket_statuses');
    }

}
