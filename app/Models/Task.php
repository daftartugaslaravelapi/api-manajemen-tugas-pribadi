<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'status_selesai',
    ];

    protected $casts = [
        'status_selesai' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
