<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //disable foreign key
        Schema::disableForeignKeyConstraints();

        Schema::table('hd_issue_hdr', function(Blueprint $table) {
            //add foreign key
            $table->foreign('pic_id')->references('id')->on('hd_pic');
        });

        Schema::table('hd_issue_dtl', function(Blueprint $table) {
            //add foreign key
            $table->foreign('issue_id')->references('id')->on('hd_issue_hdr');
        });
        //enable foreign key
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
