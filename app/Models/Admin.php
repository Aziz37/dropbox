<?php

namespace App\Models;

use App\Models\Root;
use App\Models\Files;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

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

    public function roots()
    {
    	return $this->hasMany(Root::class);
    }

    public function folders()
    {
    	return $this->hasMany(Folder::class);
    }

    public function files()
    {
    	return $this->hasMany(File::class);	
    }
}
