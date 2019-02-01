<?php
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class categories extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('categories', function($table)
        {
            $table->increments('id');
            $table->string('name');

            $table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('categories');
    }
}
