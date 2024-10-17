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
        Schema::create('guest_books', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama tamu
            $table->string('alamat'); // Alamat tamu
            $table->string('nope'); // Nomor telepon tamu
            $table->string('jenis_kelamin'); // Jenis kelamin tamu
            $table->string('asal_instansi'); // Asal instansi tamu
            $table->text('keperluan'); // Keperluan tamu
            $table->text('bertemu'); // Bertemu dengan siapa
            $table->text('photo'); // Menyimpan gambar dalam bentuk base64
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_books'); // Menghapus tabel guest_books
    }
};
