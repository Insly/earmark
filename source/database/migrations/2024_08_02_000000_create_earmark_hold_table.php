<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEarmarkHoldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('earmark_hold')) {
            Schema::create('earmark_hold', function (Blueprint $table) {
                $table->increments('id');
                $table->integer(config('earmark.columns.digit'));
                $table->string(config('earmark.columns.group'))->nullable();
                $table->timestamps();

                $table->index(config('earmark.columns.digit'));
                $table->index(config('earmark.columns.group'));
            });
        }

        // Poing\Earmark\Models\EarMark::max('digit')
        // Poing\Earmark\Models\EarMark::where('type','alpha')->max('digit')
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $legacyMigration = DB::table('migrations')->where('migration', '2019_05_22_090330_create_earmark_hold_table')->first();
        if(!$legacyMigration) {
            Schema::dropIfExists('earmark_hold');
        }
    }
}
