<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kezeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->boolean('status');
            $table->string('mark');
            $table->string('model');
            $table->string('equipment');
            $table->integer('year');
            $table->string('uslugi');
            $table->string('linza')->nullable();
            $table->integer('sum');
            $table->string('comment')->nullable();
            $table->string('tel');
            $table->dateTime('zapis');
            $table->timestamp('zayavka')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kezeks');
    }
};
