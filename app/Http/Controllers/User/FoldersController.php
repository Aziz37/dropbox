<?php

namespace App\Http\Controllers\User;

use App\Models\Folder;
use Illuminate\Http\Request;
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

        return view('users.folders.show', compact('folder', 'subfolders'));
    }
}
