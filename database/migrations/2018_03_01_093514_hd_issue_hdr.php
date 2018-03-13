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
            $table->string('nomor_issue', 20)->unique();
            $table->string('user_id', 36); //dari db_sales_development
            $table->string('form_id', 36); //dari db_sales_development
            $table->string('form_name', 100); //dari db_sales_development
            $table->string('pic_id', 36);
            $table->integer('ratting' )->nullable()->default(null); //untuk flag apakah training atau issue
            $table->string('type', 15)->nullable(); //untuk flag apakah training atau issue
            $table->string('status', 15)->nullable(); //untuk status issuenya [OPEN, RESOLVED, INPROGRESS]
            $table->boolean('is_uploaded', 15)->default(false);
            $table->timestamps();
        });

        $statmentUpdate = "            
            CREATE EVENT scheduler_issue ON SCHEDULE EVERY 1 HOUR DO 
            BEGIN
                INSERT INTO hd_issue_dtl (id, issue_id, sender_id, sender_name, keterangan, created_at, updated_at)
                    select uuid(), hdr.id, hdr.user_id, 'SYSTEM', 'Issue Telah di Closed Otomatis oleh System, mendapatkan Ratting: <strong>PUAS</strong>', now(), now() 
                    from    hd_issue_hdr hdr 
                    where   hdr.status = 'RESOLVED'
                    AND     hdr.type = 'ISSUE'
                    AND     hdr.ratting is null
                    AND     TIMESTAMPDIFF(DAY, hdr.updated_at, now()) > 2
                    ;
                    
                UPDATE hd_issue_hdr hdr SET hdr.ratting = 1, hdr.status = 'CLOSED'
                WHERE   hdr.status = 'RESOLVED'
                AND     hdr.type = 'ISSUE'
                AND     hdr.ratting is null
                AND     TIMESTAMPDIFF(DAY, hdr.updated_at, now()) > 2
                ;
                        
            END            
        ";

        //AND     TIMESTAMPDIFF(DAY, hdr.updated_at, now()) > 2

        DB::unprepared('SET GLOBAL event_scheduler = 1;');
        DB::unprepared($statmentUpdate);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP EVENT scheduler_issue');
        Schema::dropIfExists('hd_issue_hdr');
    }
}
