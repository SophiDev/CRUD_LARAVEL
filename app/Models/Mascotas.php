<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mascotas extends Model
{
    // Borrado logico SoftDelete
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'breed',
        'description',
        'categoria_id'
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];
}
