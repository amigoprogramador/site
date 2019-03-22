<?php


namespace ICTSoft\Blogfeaturedfiles\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddFeaturedfilesFieldsToBlogTable extends Migration {
	public function up() {
		Schema::table ( 'rainlab_blog_posts', function ($table) {
			$table->text ( 'bff_featuredfiles' )->nullable ();
		} );
	}
	public function down() {
		Schema::table ( 'rainlab_blog_posts', function ($table) {
			if (Schema::hasColumn ( 'rainlab_blog_posts', 'bff_featuredfiles' )) {
				$table->dropColumn ( 'bff_featuredfiles' );
			}
		} );
	}
}