<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('konyvek', function (Blueprint $table): void {
            $table->id();
            $table->string('cim', 150);
            $table->string('szerzo', 100);
            $table->string('isbn', 20)->unique();
            $table->unsignedSmallInteger('kiadas_eve');
            $table->foreignId('olvaso_id')->nullable()->constrained('olvasok')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('konyvek'); }
};
