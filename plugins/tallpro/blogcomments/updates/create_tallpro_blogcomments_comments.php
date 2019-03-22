<?php namespace Tallpro\BlogComments\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTallproBlogcommentsComments extends Migration
{
    public function up()
    {
        Schema::create('tallpro_blogcomments_comments', function($table)
        {

            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->integer('post_id')->nullable();
            $table->text('comment')->nullable();
            $table->smallInteger('status')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('url');
            $table->ipAddress('ip')->nullable();

        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tallpro_blogcomments_comments');
    }
}
