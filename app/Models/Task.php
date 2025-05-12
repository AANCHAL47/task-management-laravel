<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'status',
        'created_by',
        'due_date'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function userAssignedBy() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
