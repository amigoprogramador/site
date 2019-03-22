<?php namespace TwoCreate\AuthorBio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class SocialAndOtherFields extends Migration
{

    public function up()
    {

        Schema::table('backend_users', function ($table) {
            $table->string('facebook_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('user_position_name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('backend_users', function ($table) {
            
            $table->dropColumn('facebook_link');
            $table->dropColumn('linkedin_link');
            $table->dropColumn('twitter_link');
            $table->dropColumn('instagram_link');
            $table->dropColumn('youtube_link');
            $table->dropColumn('user_position_name');
        });
    }

}