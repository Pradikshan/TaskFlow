<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $dates = ['due_date'];


    protected $fillable = [
        'user_id',
        'title',
        'category',
        'description',
        'priority',
        'location',
        'due_date'
    ];

    public function subtasks()
    {
        return $this->hasMany(Subtask::class, 'task_id');
    }
    
}
