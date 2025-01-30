<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    protected $fillable = ['name'];
    // berfungsi untuk  mengontrol variable nama 
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function tasks() {
        return $this->hasMany(Task::class, 'list_id');
    }
}
