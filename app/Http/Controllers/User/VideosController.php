<?php

namespace App\Http\Controllers\User;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VideosController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(Request $request)
    {
    	$rootId = 0;
    	$folderId = 0;

    	if($request->has('root_id'))
    	{
    		$rootId = $request->input('root_id');

    		Video::create([
	            	'user_id'	   =>  Auth::user()->id,
	                'root_id'      =>  $rootId,
	                'video_name'   =>  $request->input('video_name'),
	                'url'          =>  $request->input('url')
	            ]);

    		session()->flash('message', 'Video Saved Successfully !');

        	return redirect()->action('User\RootFoldersController@show', compact('rootId'));
    	}

    	elseif($request->has('folder_id'))
    	{
    		$folderId = $request->input('folder_id');

    		Video::create([
	            	'user_id'	   =>  Auth::user()->id,
	                'folder_id'    =>  $folderId,
	                'video_name'   =>  $request->input('video_name'),
	                'url'          =>  $request->input('url')
	            ]);

    		session()->flash('message', 'Video Saved Successfully !');

        	return redirect()->action('User\FoldersController@show', compact('folderId'));
        }
    }

    public function show($id)
    {
    	$video = Video::findOrFail($id);

    	$url = $video->url;

        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id))
        {
          $values = $id[1];
        }
        else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id))
        {
          $values = $id[1];
        }
        else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id))
        {
          $values = $id[1];
        }
        else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id))
        {
          $values = $id[1];
        }
        else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        }
        
        return view('users.video', compact('video', 'values'));
    }

    public function destroy($id)
    {
    	$video = Video::findOrFail($id);

    	if($video->user_id === Auth::user()->id && is_null($video->admin_id))
    	{
    		$video->delete();

    		session()->flash('message', 'Video removed Successfully !');

    		return redirect()->back();
    	}

    	session()->flash('message', 'You are not authorized to delete this video !');

    	return redirect()->back();
    }
}
