<?php
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Product as Product;
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
            $table->string('name',50);
            $table->integer('quantity');

            $table->timestamps();
        });

        $array = array(
            array(
                'category_id' => 1,
                'name' => 'laptop',
                'quantity' => '20'
            ),
            array(
                'category_id' => 1,
                'name' => 'mouse',
                'quantity' => '30'
            ),
            array(
                'category_id' => 1,
                'name' => 'copmuter',
                'quantity' => '15'
            ),
            array(
                'category_id' => 2,
                'name' => 'desk',
                'quantity' => '60'
            )
          );
        Product::insert($array);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('products');
    }
}
