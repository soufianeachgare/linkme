<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSocial extends Model
{
    use HasFactory;
    protected $table = 'type_social';

    protected $fillable = [
        'name',
        'd'
        // Add any additional fillable columns as needed
    ];
}
