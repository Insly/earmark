<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAccrualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //fixes the issue of legacy databases already having the
        if (!Schema::hasTable('earmark_accrual')) {
            Schema::create('earmark_accrual', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $legacyMigration = DB::table('migrations')->where('migration', '2019_05_27_062621_create_accruals_table')->first();
        if(!$legacyMigration){
            Schema::dropIfExists('earmark_accrual');
        }
    }
}
