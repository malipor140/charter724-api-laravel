<?php
/**
 * Developed by Alireza Hamedashki.
 * Email: a.hamedashki@gmail.com
 * Mobile: +98 938 900 4559
 * Date: 5/16/19
 * Time: 2:34 PM
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharter724Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('charter724.table_names');
        $columnNames = config('charter724.column_names');

        Schema::create($tableNames['airports'], function (Blueprint $table) use($tableNames, $columnNames) {
            $table->bigIncrements('id');
            $table->integer($columnNames['code_int']);
            $table->string($columnNames['name_en']);
            $table->string($columnNames['name_fa']);
            $table->string($columnNames['IATA_airport']);
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
        $tableNames = config('charter724.table_names');

        Schema::dropIfExists($tableNames['airports']);
    }
}
