<?php
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Category as Category;
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

        $array = array(
            array(
                'name' => 'technology'
            ),
            array(
                'name' => 'desk'
            ),
            array(
                'name' => 'foods'
            ),
            array(
                'name' => 'home'
            ),
            array(
                'name' => 'pets'
            ),
            array(
                'name' => 'wood'
            ),
            array(
                'name' => 'toys'
            ),
            array(
                'name' => 'vehicles'
            ),
            array(
                'name' => 'accesories'
            ),
            array(
                'name' => 'education'
            ),
            array(
                'name' => 'entertainment'
            ),
            array(
                'name' => 'stationery'
            )
          );
        Category::insert($array);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('categories');
    }
}
