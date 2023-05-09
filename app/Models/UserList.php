<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    use HasFactory;

    protected $fillable = ['number'];

    public function manga()
    {
        return $this->belongsTo(MangaOverView::class, 'manga_over_view_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}