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

    protected $fillable = ['name', 'email', 'password', 'profile_photo', 'background_photo', 'about', 'message', 'report_message', 'report_chapter', 'create_manga', 'update_manga', 'delete_manga', 'upload_manga_chapter', 'update_manga_chapter', 'delete_manga_chapter', 'create_novel', 'update_novel', 'delete_novel', 'upload_novel_chapter', 'update_novel_chapter', 'delete_novel_chapter', 'create_people', 'update_people', 'delete_people', 'ban_user', 'unban_user'];

    protected $hidden = ['password', 'email'];

    public function getAboutAttribute()
    {
        return !$this->attributes['about'] ? 'Nada informado' : $this->attributes['about'];
    }

    public function getProfilePhotoAttribute()
    {
        return !$this->attributes['profile_photo'] ? asset("imgs/profile.jpg") : asset("storage/" . $this->attributes['profile_photo']);
    }

    public function getBackgroundPhotoAttribute()
    {
        return !$this->attributes['background_photo'] ? asset("imgs/background_profile.jpg") : asset("storage/" . $this->attributes['background_photo']);
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
}
