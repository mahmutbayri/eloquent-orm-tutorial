<?php

use Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if($this->schema->hasTable('phones'))
        {
            $this->down();
        }

        $this->schema->create('phones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('phones');
    }
}
