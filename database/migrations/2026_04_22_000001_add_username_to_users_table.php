<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username')->nullable()->unique()->after('name');
            });
        }

        DB::table('users')
            ->where('email', 'admin@psu.edu.ph')
            ->update([
                'username' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]);

        DB::table('users')
            ->where('email', 'instructor@psu.edu.ph')
            ->update([
                'username' => 'teacher',
                'role' => 'teacher',
            ]);

        DB::table('users')
            ->whereNull('username')
            ->orderBy('id')
            ->get()
            ->each(function ($user) {
                $fallbackUsername = strstr((string) $user->email, '@', true) ?: ('user'.$user->id);

                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['username' => $fallbackUsername]);
            });
    }
    public function down(): void
    {
        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            });
        }
    }
};
