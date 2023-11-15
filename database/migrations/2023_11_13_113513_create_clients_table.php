<?php

use App\Models\Client;
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
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('account');
            $table->string('avatar');
            $table->integer('project');
            $table->float('invoices');
            $table->string('tags');
            $table->string('category');
            $table->string('status')->default(Client::IS_ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
