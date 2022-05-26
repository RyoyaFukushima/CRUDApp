<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // タイトルを追加
        Schema::table('contact_forms', function (Blueprint $table) {
            // 任意のコラムの後に追加するのでafter使う
            $table->string('title', 50)->after('your_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // コラムを削除したい場合
    public function down()
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            //
        });
    }
};
