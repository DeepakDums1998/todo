<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TodoItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status', 'todo_id'];

    public function todo(): BelongsTo
    {
        return $this->belongsTo(Todo::class);
    }
}
