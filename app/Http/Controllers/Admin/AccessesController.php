<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Folder;
use App\Models\FolderUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccessesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function store(Request $request)
    {
    	$user = User::findOrFail($request->input('user_id'));
        $folder = $request->input('folder_id');

        $user->folders()->attach($folder);

    	session()->flash('message', 'Access granted ');

    	return redirect()->back();
    }	

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));
        $folder = $request->input('folder_id');

        $user->folders()->detach($folder);

        session()->flash('message', 'Access revoked');

        return redirect()->back();
    }
}
