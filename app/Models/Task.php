<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\To_Do_List;


class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    /**
     * Get the user that owns the task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Get the to_do_list that this task belongs to.
     */
    public function to_do_list(): BelongsTo
    {
        return $this->belongsTo(To_Do_List::class);
    }

    /**
     * Get the task due date.
     */
    public function dueDate(){
        return $this->due_date;
    } 
}
