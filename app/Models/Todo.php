<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // Define the attributes that are mass assignable
    protected $fillable = [
        'title',
        'priority',
        'status',
        'user_id', // Assuming each Todo is associated with a user
    ];

    // Define the relationship to the User model (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with TodoItems
    public function todoItems()
    {
        return $this->hasMany(TodoItem::class);
    }
}
