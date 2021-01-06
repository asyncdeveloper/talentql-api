<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    protected $casts = [
        'is_completed' => 'boolean'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'due_date'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
