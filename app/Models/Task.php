<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskList;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_completed',
        'priority',
        'list_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    const PRIORITIES = [
        'low',
        'medium',
        'high'
    ];
    // const adalah sebuah nilai yang tidak bisa dirubah

    public function getPriorityClassAttribute() {
        return match($this->attributes['priority']) {
            'low' => 'success',
            'medium' => 'warning',
            'high' => 'danger',
            default => 'secondary'
        };
    }
    // success warna hijau, warning warna kuning, default yaitu bawaan, secondary abu abu/bawaan
    // untuk mendapatkan sebuah prioritas yang nantinya setiap prioritas akan diberikan warna sesuai kondisi

    public function list() {
        return $this->belongsTo(TaskList::class, 'list_id');
    }
}