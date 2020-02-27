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
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('gift_code_id')->nullable();
            $table->unsignedInteger('city_id');

            $table->index(["gift_code_id"]);
            $table->index(["city_id"]);
            $table->index(["plan_id"]);


            $table->foreign('plan_id')
                ->references('id')->on('plans')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('gift_code_id')
                ->references('id')->on('gift_codes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('city_id')
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
