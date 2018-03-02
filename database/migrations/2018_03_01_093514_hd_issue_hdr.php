<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HdIssueHdr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hd_issue_hdr', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('subject', 100);
            $table->string('nomor_issue', 20);
            $table->string('user_id', 36); //dari db_sales_development
            $table->string('form_id', 36); //dari db_sales_development
            $table->string('form_name', 100); //dari db_sales_development
            $table->string('pic_id', 36);
            $table->string('type', 15)->nullable();; //untuk flag apakah training atau issue
            $table->string('status', 15)->nullable();; //untuk status issuenya [OPEN, RESOLVED, INPROGRESS]
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
        Schema::dropIfExists('hd_issue_hdr');
    }
}
