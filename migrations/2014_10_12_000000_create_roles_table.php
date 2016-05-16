<?php

use Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if($this->schema->hasTable('roles'))
        {
            $this->down();
        }

        $this->schema->create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('roles');
    }
}
