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
        //
        Schema::table('quotations', function (Blueprint $table) {
            // Required — no excuse for these to be empty
            $table->string('contact_name');
            $table->string('company_name');
            $table->string('email');

            // Genuinely optional
            $table->string('phone')->nullable();
            $table->string('material')->nullable();
            $table->integer('quantity')->nullable();
            $table->date('required_date')->nullable();
            $table->string('product_category', 50)->nullable();

            // System generated
            $table->string('reference', 30)->nullable();
            $table->uuid('token')->nullable();

            // Existing columns being altered
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->decimal('quotation_price', 10, 2)->nullable()->change();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn([
                'contact_name', 'company_name', 'email', 'phone',
                'material', 'quantity', 'required_date',
                'product_category', 'reference', 'token',
            ]);

            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->decimal('quotation_price', 10, 0)->nullable(false)->change();
         });
    }
};
