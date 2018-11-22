<?php

namespace App\Models;

use App\Models\File;
use App\Models\Admin;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Model;

class Root extends Model
{
	public function admin()
	{
		return $this->belongsTo(Admin::class);
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
