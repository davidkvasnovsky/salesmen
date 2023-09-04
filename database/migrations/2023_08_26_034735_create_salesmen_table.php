<?php

declare(strict_types=1);

use Domains\Support\Enums\GenderEnum;
use Domains\Support\Enums\MaritalStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create(table: 'salesmen', callback: static function (Blueprint $table): void {
            $table->uuid(column: 'id');
            $table->string(column: 'first_name', length: 50);
            $table->string(column: 'last_name', length: 50);
            $table->jsonb(column: 'titles_before')->nullable();
            $table->jsonb(column: 'titles_after')->nullable();
            $table->string(column: 'prosight_id', length: 5);
            $table->string(column: 'email');
            $table->string(column: 'phone')->nullable();
            $table->enum(column: 'gender', allowed: GenderEnum::values());
            $table->enum(column: 'marital_status', allowed: MaritalStatusEnum::values())->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: 'salesmen');
    }
};
