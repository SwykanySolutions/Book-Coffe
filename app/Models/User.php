<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Searchable;

    protected $fillable = ['name', 'email', 'password', 'profile_photo', 'background_photo', 'about', 'balance', 'exp'];

    protected $hidden = ['password', 'email'];

    public function searchableAs()
    {
        return 'id';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['name'] = $this->name;

        return $array;
    }

    public function getAboutAttribute()
    {
        return !$this->attributes['about'] ? 'Nada informado' : $this->attributes['about'];
    }

    public function getProfilePhotoAttribute()
    {
        return !$this->attributes['profile_photo'] ? "imgs/profile.jpg" :  $this->attributes['profile_photo'];
    }

    public function getBackgroundPhotoAttribute()
    {
        return !$this->attributes['background_photo'] ? "imgs/background_profile.jpg" :  $this->attributes['background_photo'];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setNameAttribute($value)
    {
        if (!preg_match("/#/i", $value)) {
            $this->attributes['name'] = $value . sprintf("#%'04d", rand(0, 9999));
        } else {
            $this->attributes['name'] = $value;
        }
    }

    public function chapter_mangas()
    {
        return $this->hasMany(ChapterManga::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function frames()
    {
        return $this->belongsToMany(Frame::class);
    }
}