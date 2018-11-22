<?php

namespace App\Http\Controllers\User;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
    	$rootId = 0;
    	$folderId = 0;
    	$files = $request->file('file');

    	if($request->has('root_id'))
    	{
    		$rootId = $request->input('root_id');

    		foreach($files as $file)
	        {
	            File::create([
	            	'user_id'	   =>  Auth::user()->id,
	                'root_id'      =>  $rootId,
	                'filename'     =>  $file->getClientOriginalName(),
	                'path'         =>  $file->store('public/storage')
	            ]);
	        }

	        session()->flash('message', 'File(s) Uploaded Successfully !');

        	return redirect()->action('User\RootFoldersController@show', compact('rootId'));
    	}

    	elseif($request->has('folder_id'))
    	{
    		$folderId = $request->input('folder_id');

    		foreach($files as $file)
	        {
	            File::create([
	            	'user_id'	   =>  Auth::user()->id,
	                'folder_id'    =>  $folderId,
	                'filename'     =>  $file->getClientOriginalName(),
	                'path'         =>  $file->store('public/storage')
	            ]);
	        }

	        session()->flash('message', 'File Uploaded Successfully !');

        	return redirect()->action('User\FoldersController@show', compact('folderId'));
    	}
    }

    public function show($id)
    {
        $download = File::findOrFail($id);
        return Storage::download($download->path, $download->filename);
    }

    public function destroy($id)
    {
    	$file = File::findOrFail($id);

        $rootId 	= 	$file->root_id;
    	$folderId 	= 	$file->folder_id;
        
        if($file->user_id === Auth::user()->id && is_null($file->admin_id))
        {
            Storage::delete($file->path);
            $file->delete();

            session()->flash('message', 'File Deleted Successfully !');
            
            if($folderId != 0)
            {
                return redirect()->action('User\FoldersController@show', compact('folderId'));
            }
            
            return redirect()->action('User\RootFoldersController@show', compact('rootId'));
        }

    	session()->flash('message', 'You are not authorized to delete this file');

        return redirect()->back();

    }
}
