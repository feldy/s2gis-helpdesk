<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HdIssueDtl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hd_issue_dtl', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('issue_id', 36);
            $table->string('sender_id', 36); //isinya user_sid pengirim dari db_sales_development
            $table->string('receiver_id', 36); //isinya user_sid penerima dari db_sales_development
            $table->text('keterangan');
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
        Schema::dropIfExists('hd_issue_dtl');
    }
}
