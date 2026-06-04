<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('product_code')->nullable()->unique()->after('id');
        });

        // Back-fill: assign sequential codes ordered by id (SQLite + MySQL compatible)
        $ids = DB::table('products')->orderBy('id')->pluck('id');
        foreach ($ids as $index => $id) {
            DB::table('products')->where('id', $id)->update(['product_code' => $index + 1]);
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('product_code');
        });
    }
};
