<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Index for books search (title and author)
        Schema::table('books', function (Blueprint $table) {
            $table->index('title');
            $table->index('author');
            $table->index('category_id');
            $table->index('is_available');
        });

        // Index for borrowings search and status checks
        Schema::table('borrowings', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('book_id');
            $table->index('status');
            $table->index('due_at');
            $table->index(['status', 'due_at']);
        });

        // Index for users search
        Schema::table('users', function (Blueprint $table) {
            $table->index('name');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropIndex(['title']);
            $table->dropIndex(['author']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['is_available']);
        });

        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['book_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['due_at']);
            $table->dropIndex(['status', 'due_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['email']);
        });
    }
};
