<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'requested_by_user_id')->constrained('users');
            $table->foreignIdFor(User::class, 'requested_to_user_id')->constrained('users');
            $table->timestamp('connected_at')->nullable();
            $table->timestamps();

            $table->unique(['requested_by_user_id', 'requested_to_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connection');
    }
};
