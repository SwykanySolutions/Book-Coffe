<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $fillable = ['name', 'editable', 'deletable', 'position'];

    protected $auditInclude = [
        'name',
        'position',
        'editable',
        'deletable',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function  resources()
    {
        return $this->belongsToMany(Resource::class);
    }
}
