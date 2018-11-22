<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Files;
use App\Models\Root;
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
}
