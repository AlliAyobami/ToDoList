<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\ToDoList;
use App\Status;
use App\Priority;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->enum('status', Status::toArray())->default(Status::PENDING->value);
            $table->enum('priority', Priority::toArray())->default(Priority::MEDIUM->value);
            $table->foreignIdFor(User::class)->onDelete('cascade');
            $table->foreignIdFor(ToDoList::class)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
