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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change();

            $table->string('client1_name')->nullable()->after('user_id');
            $table->string('client2_name')->nullable()->after('client1_name');
            $table->string('family_name')->nullable()->after('client2_name');
            $table->string('email')->nullable()->after('family_name');
            $table->string('phone_mobile1')->nullable()->after('email');
            $table->string('phone_mobile2')->nullable()->after('phone_mobile1');
            $table->unsignedSmallInteger('adults_count')->default(1)->after('phone_mobile2');
            $table->unsignedSmallInteger('children_count')->default(0)->after('adults_count');
            $table->string('language')->nullable()->after('children_count');
            $table->string('sector')->nullable()->after('language');
            $table->string('kashrut')->nullable()->after('sector');
            $table->string('trip_purpose')->nullable()->after('kashrut');
            $table->string('payment_method')->nullable()->after('trip_purpose');
            $table->json('details')->nullable()->after('payment_method');

            $table->uuid('confirmation_token')->nullable()->after('status');
            $table->timestamp('confirmed_at')->nullable()->after('confirmation_token');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'client1_name', 'client2_name', 'family_name',
                'email', 'phone_mobile1', 'phone_mobile2',
                'adults_count', 'children_count',
                'language', 'sector', 'kashrut', 'trip_purpose', 'payment_method',
                'details', 'confirmation_token', 'confirmed_at',
            ]);
        });
    }
};
