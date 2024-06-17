<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateLessonsTable extends Migration
{
    public function up()
    {
        DB::table('lessons')->truncate();
        DB::statement('ALTER TABLE lessons AUTO_INCREMENT = 1');
    }

    public function down()
    {
        // Если нужно откатываться, можно добавить код для восстановления данных.
    }
}
