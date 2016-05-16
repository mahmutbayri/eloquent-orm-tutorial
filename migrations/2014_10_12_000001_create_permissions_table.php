<?php

use Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if($this->schema->hasTable('permissions'))
        {
            $this->down();
        }

        $this->schema->create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permissible_type');
            $table->integer('permissible_id');
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('permissions');
    }
}
