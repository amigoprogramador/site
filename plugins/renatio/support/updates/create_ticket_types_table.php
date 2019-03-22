<?php

namespace Renatio\Support\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTicketTypesTable extends Migration
{

    /**
     * @return void
     */
    public function up()
    {
        Schema::create('renatio_support_ticket_types', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 255);
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
        Schema::dropIfExists('renatio_support_ticket_types');
    }

}
