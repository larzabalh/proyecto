<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('rol')->nullable;
            $table->integer('statusUser')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        \DB::table('users')->insert(
        ['name' => 'Hernan', 'email' => 'larzabalh@hotmail.com',
         'password' => '$2y$10$xMbRDhZDFgDdYxVy21VWquCketN/Wmy1CakRoLd2m2kcs6.y6INoy','rol' => 'administrador',
         'statusUser'=>1, 'created_at'=>'2017-01-01', 'updated_at'=>'2017-01-01'
        ]
      );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
