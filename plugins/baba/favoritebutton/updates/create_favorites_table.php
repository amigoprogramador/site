<?php

namespace BABA\Favoritebutton\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFavoritesTable extends Migration {

    public function up() {
        if (!Schema::hasTable('baba_favorites_favorites')) {
            Schema::create('baba_favorites_favorites', function(Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('user_id')->unsigned()->index();
                $table->morphs('favoriteable');

                $table->primary(['user_id', 'favoriteable_id', 'favoriteable_type'], 'id');
                $table->timestamps();
            });
        }
    }

    public function down() {
        Schema::dropIfExists('baba_favorites_favorites');
    }

}
