<?php

namespace App\Models;

use App\Models\Root;
use App\Models\User;
use App\Models\Admin;
use App\Models\Files;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function admin()
    {
    	return $this->belongsTo(Admin::class);
    }

    public function root()
    {
    	return $this->belongsTo(Root::class);
    }

    public function files()
    {
    	return $this->hasMany(File::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
