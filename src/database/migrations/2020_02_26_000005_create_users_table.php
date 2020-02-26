<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email', 100);
            $table->text('password');
            $table->string('language', 20)->nullable();
            $table->time('timezone');
            $table->string('operation_system', 10)->nullable();
            $table->text('access_token')->nullable();
            $table->integer('plans_id');
            $table->integer('gift_codes_id')->nullable();
            $table->integer('cities_id');

            $table->index(["gift_codes_id"], 'fk_users_gift_codes1_idx');

            $table->index(["cities_id"], 'fk_users_cities1_idx');

            $table->index(["plans_id"], 'fk_users_plans_idx');


            $table->foreign('plans_id', 'fk_users_plans_idx')
                ->references('id')->on('plans')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('gift_codes_id', 'fk_users_gift_codes1_idx')
                ->references('id')->on('gift_codes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('cities_id', 'fk_users_cities1_idx')
                ->references('id')->on('cities')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
