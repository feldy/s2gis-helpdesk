<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HdPic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hd_pic', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('name', 100);
            $table->string('initial_name', 5);
            $table->string('user_id', 36);//isinya user_sid dari db_sales_development
            $table->string('type', 15); //[ANALIS, PROGRAMMER]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('hd_pic');
        Schema::enableForeignKeyConstraints();
    }
}
