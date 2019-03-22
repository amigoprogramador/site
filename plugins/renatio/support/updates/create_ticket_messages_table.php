<?php

namespace Renatio\Support\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTicketMessagesTable
 * @package Renatio\Support\Updates
 */
class CreateTicketMessagesTable extends Migration
{

    /**
     * @return void
     */
    public function up()
    {
        Schema::create('renatio_support_ticket_messages', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('ticket_id')->unsigned()->index();
            $table->text('reply');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renatio_support_ticket_messages');
    }

}
