<?php

namespace App\Http\Controllers\Admin;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FoldersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

    public function create()
    {
        return view('admin.folders.create');
    }

    public function store(Request $request)
    {
    	$parentId = 0;
        $rootId = 0;

        if($request->has('root_id'))
        {
            $rootId = $request->input('root_id');
        }
    	elseif($request->has('parent_id'))
    	{
    		$parentId = $request->input('parent_id');
    	}

    	$this->validate($request, [
    		'name' => 'required|string',
    	]);

    	$folder = new Folder;

    	$folder->admin_id 	= 	Auth::user()->id;
    	$folder->root_id	=	$rootId;
    	$folder->parent_id	=	$parentId;
    	$folder->name 		=	$request->input('name');

    	$folder->save();

    	session()->flash('message', 'Folder Created Successfully !');

    	return redirect()->back();
    }

    public function show($id)
    {
        $folder = Folder::findOrFail($id);

        $subfolders = Folder::where('parent_id', '=', $id)->get();

        return view('admin.folders.show', compact('folder', 'subfolders'));
    }

    public function edit($id)
    {
        $folder = Folder::findOrFail($id);

        return view('admin.folders.edit', compact('folder'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        Folder::where('id', '=', $id)->update([
            'name' => $request->input('name')
        ]);

        $folder = Folder::findOrFail($id);

        session()->flash('message', 'Changes made successfully !');

        if($folder->root_id != 0 )
        {
            $rootId = $folder->root_id;

            return redirect()->action('Admin\RootFoldersController@show', compact('rootId'));
        }

        return $this->show($folder->parent_id);
    }

    public function destroy($id)
    {
    	$folder = Folder::findOrFail($id);

    	$folder->delete();

    	session()->flash('message', 'Folder deleted successfully !');

        if($folder->root_id != 0 )
        {
            $rootId = $folder->root_id;

            return redirect()->action('Admin\RootFoldersController@show', compact('rootId'));
        }

    	return $this->show($folder->parent_id);
    }
}
