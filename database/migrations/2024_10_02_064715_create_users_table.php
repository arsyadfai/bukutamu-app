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
            $table->string('nope')->after('name'); // Nomor Telepon
            $table->string('alamat')->after('nope'); // Alamat
            $table->string('jenis_kelamin')->after('alamat'); // Jenis Kelamin
            $table->string('bertemu')->after('jenis_kelamin'); // Bertemu Dengan Siapa
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guest_books', function (Blueprint $table) {
            $table->dropColumn(['nope', 'alamat', 'jenis_kelamin', 'bertemu']);
        });
    }
};
