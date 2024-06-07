<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = ['user_id', 'name', 'url'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
