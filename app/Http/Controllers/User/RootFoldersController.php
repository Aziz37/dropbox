<?php

namespace App\Http\Controllers\User;

use App\Models\Root;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RootFoldersController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function show($id)
    {
    	$rootFolder = Root::findOrFail($id);

    	return view('users.folders.index', compact('rootFolder'));
    }
}
