<?php

namespace App\Http\Controllers\Admin;

use App\Models\File;
use App\Models\Root;
use App\Models\User;
use App\Models\Admin;
use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
    	$query = $request->input('search');

    	$email 			= 	Admin::where('email', 'LIKE', '%'.$query.'%');
    	$department 	= 	Admin::where('department', 'LIKE', '%'.$query.'%');
    	$adminResults 	= 	Admin::where('name', 'LIKE', '%'.$query.'%')
					   			  ->union($email)
							      ->union($department)
							      ->get();

		$email 			= 	User::where('email', 'LIKE', '%'.$query.'%');
    	$department 	= 	User::where('department', 'LIKE', '%'.$query.'%');
    	$userResults 	= 	User::where('name', 'LIKE', '%'.$query.'%')
					   			 ->union($email)
							     ->union($department)
							     ->get();

		$rootFolders 	= 	Root::where('name', 'LIKE', '%'.$query.'%')
								 ->get();

		$folderResults 	=	Folder::where('name', 'LIKE', '%'.$query.'%')
								  ->where('id', '>', 1)
								  ->get();

		$fileResults	=	File::where('filename', 'LIKE', '%'.$query.'%')
								 ->get();
		
    	return view('admin.results', compact(
    		'query', 
    		'adminResults', 
    		'userResults',
    		'rootFolders',
    		'folderResults',
    		'fileResults'
    	));
    }
}
