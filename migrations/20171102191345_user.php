<?php
use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\User as Users;
class User extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('user', function($table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        $array = array(
            array(
                'username'  => 'admin',
                'email'     => 'admin@manpower.com',
                'password'  => password_hash('admin123',PASSWORD_DEFAULT)
            )
        );
        Users::insert($array);
    }
    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('user');
    }
}
