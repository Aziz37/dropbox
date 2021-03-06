<?php

namespace App\Models;

use App\Models\File;
use App\Models\Video;
use App\Models\Folder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function files()
    {
    	return $this->hasMany(File::class);
    }

    public function video()
    {
        return $this->hasMany(Video::class);
    }

    public function folders()
    {
        return $this->belongsToMany(Folder::class);
    }
}