<?php

namespace App\Http\Controllers\User;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FoldersController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function show($id)
    {
    	$folder = Folder::findOrFail($id);

        $subfolders = Folder::where('parent_id', '=', $id)->get();

        if($folder->users()->where('folder_id', '=', $folder->id)->exists() && $folder->users()->where('user_id', '=', Auth::user()->id)->exists())
        {
            return view('users.folders.show', compact('folder', 'subfolders'));   
        }

        session()->flash('message', 'You are not authorized to access this folder');

        return redirect()->back();
    }
}
