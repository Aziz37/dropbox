<?php

namespace App\Models;

use App\Models\Root;
use App\Models\User;
use App\Models\Admin;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];
	
	public function admin()
	{
		return $this->belongsTo(Admin::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function root()
	{
		return $this->belongsTo(Root::class);
	}

    public function folder()
    {
    	return $this->belongsTo(Folder::class);
    }
}
