<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constants', function (Blueprint $table) {
            $table->string('app', 50)->nullable()->comment('Application');
            $table->string('key', 50)->comment('Key');
            $table->string('type', 20)->comment('Constant type');
            $table->text('value')->nullable()->comment('Value');
            $table->string('remark', 255)->nullable()->comment('Remark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constants');
    }
}
