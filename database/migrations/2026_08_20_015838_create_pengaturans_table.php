<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaturans', function (Blueprint $table) {
    $table->id();

    // IDENTITAS WEBSITE
    $table->string('nama_kosa')->nullable();
    $table->string('logo')->nullable();
    $table->string('favicon')->nullable();
    $table->text('deskripsi')->nullable();

    // KONTAK
    $table->string('telepon')->nullable();
    $table->string('whatsapp')->nullable();
    $table->string('email')->nullable();
    $table->text('alamat')->nullable();

    // MEDIA SOSIAL
    $table->string('instagram')->nullable();
    $table->string('facebook')->nullable();
    $table->string('youtube')->nullable();
    $table->string('linkedin')->nullable();

    // PESAN KETUA
    $table->text('pesan_ketua')->nullable();

    // FOOTER
    $table->text('deskripsi_footer')->nullable();
    $table->string('copyright')->nullable();

    // SEO
    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();
    $table->text('meta_keywords')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
