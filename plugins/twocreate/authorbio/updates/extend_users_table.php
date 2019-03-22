<?php namespace TwoCreate\AuthorBio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ExtendsUserTable extends Migration
{

    public function up()
    {

        Schema::table('backend_users', function ($table) {
            $table->text('biography')->nullable();
            $table->text('short_biography')->nullable();
        });
    }

    public function down()
    {
        Schema::table('backend_users', function ($table) {
            $table->dropColumn('biography');
            $table->dropColumn('short_biography');
        });
    }

}