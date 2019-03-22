<?php namespace TwoCreate\AuthorBio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class ContactInfoFields extends Migration
{

    public function up()
    {

        Schema::table('backend_users', function ($table) {
            $table->string('primary_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('skype_username')->nullable();
            $table->string('public_email')->nullable();
            $table->string('private_email')->nullable();
        });
    }

    public function down()
    {
        Schema::table('backend_users', function ($table) {
            
            $table->dropColumn('primary_phone');
            $table->dropColumn('mobile_phone');
            $table->dropColumn('skype_username');
            $table->dropColumn('public_email');
            $table->dropColumn('private_email');
        });
    }

}