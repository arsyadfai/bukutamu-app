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
        Schema::table('guest_books', function (Blueprint $table) {
            $table->string('nope')->after('name');  // Kolom untuk nomor telepon
            $table->string('bertemu')->after('keperluan');  // Kolom untuk bertemu dengan siapa
        });
    }
    
    public function down()
    {
        Schema::table('guest_books', function (Blueprint $table) {
            $table->dropColumn(['nope', 'bertemu']);
        });
    }
    
};
