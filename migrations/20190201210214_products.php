<?php
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class products extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('products', function($table)
        {
            $table->charset ='utf8';
            $table->collation='utf8_spanish_ci';
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name',3,50);
            $table->integer('quantity');

            $table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('products');
    }
}
