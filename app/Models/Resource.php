<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'resource', 'description', 'is_menu'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
