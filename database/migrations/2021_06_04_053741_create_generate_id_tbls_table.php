<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerateIdTblsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
                CREATE TRIGGER id_store BEFORE INSERT ON staff FOR EACH ROW
                    BEGIN
                        INSERT INTO sequence_tbls VALUES (NULL);
                        SET NEW.rec_id = CONCAT("KHM_", LPAD(LAST_INSERT_ID(), 10, "0"));
                    END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::unprepared('DROP TRIGGER "id_store"');
    }
}
