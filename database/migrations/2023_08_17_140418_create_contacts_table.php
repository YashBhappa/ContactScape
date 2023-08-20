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
        // $faker = \Faker\Factory::create();

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("company_id")->constrained()->onDelete("cascade");
            $table->string("first_name", 100);
            $table->string("last_name", 100);
            $table->string("phone", 100)->nullable();
            $table->string("email", 100)->nullable();
            $table->string("address")->nullable();
            $table->string("position", 100)->nullable();
            $table->string("city", 100)->nullable();
            $table->string("country", 100)->nullable();
            $table->string("interest", 100)->nullable();
            $table->string("channel", 100)->nullable();
            $table->timestamps();

            // $table->unsignedBigInteger("company_id");
            // $table->foreign("company_id")->references("id")->on("companies")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
