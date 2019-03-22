<?php

namespace Renatio\Support\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateTicketsTable
 * @package Renatio\Support\Updates
 */
class CreateTicketsTable extends Migration
{

    /**
     * @return void
     */
    public function up()
    {
        Schema::create('renatio_support_tickets', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->tinyInteger('status_id')->unsigned()->index();
            $table->tinyInteger('type_id')->unsigned()->index();
            $table->string('subject');
            $table->text('content');
            $table->boolean('is_closed')->default(false);
            $table->datetime('status_updated_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renatio_support_tickets');
    }

}
