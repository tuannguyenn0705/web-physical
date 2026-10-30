<?php

use Database\Seeders\PageSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('deals')) {
            Schema::table('deals', function (Blueprint $table) {
                if (! Schema::hasColumn('deals', 'coupon_code')) {
                    $table->string('coupon_code', 60)->nullable()->after('affiliate_url');
                }
                if (! Schema::hasColumn('deals', 'is_featured')) {
                    $table->boolean('is_featured')->default(true)->after('is_active');
                }
                if (! Schema::hasColumn('deals', 'clicks_count')) {
                    $table->unsignedBigInteger('clicks_count')->default(0)->after('order');
                }
            });

            // Enrich existing sample deals with coupon codes & featured flags
            DB::table('deals')->where('title', 'like', '%Cursor%')->update([
                'coupon_code' => 'CURSOR50',
                'is_featured' => true,
            ]);
            DB::table('deals')->where('title', 'like', '%Jasper%')->update([
                'coupon_code' => 'JASPER60',
                'is_featured' => true,
            ]);
            DB::table('deals')->where('title', 'like', '%Perplexity%')->update([
                'coupon_code' => 'PROAI70',
                'is_featured' => true,
            ]);
        }

        if (! Schema::hasTable('subscribers')) {
            Schema::create('subscribers', function (Blueprint $table) {
                $table->id();
                $table->string('email')->unique();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (Schema::hasTable('pages')) {
            (new PageSeeder)->run();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');

        if (Schema::hasTable('deals')) {
            Schema::table('deals', function (Blueprint $table) {
                $columns = array_filter(
                    ['coupon_code', 'is_featured', 'clicks_count'],
                    fn (string $col) => Schema::hasColumn('deals', $col)
                );
                if (! empty($columns)) {
                    $table->dropColumn($columns);
                }
            });
        }
    }
};
