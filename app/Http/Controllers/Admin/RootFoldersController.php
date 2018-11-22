<?php

namespace App\Http\Controllers\Admin;

use App\Models\Root;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RootFoldersController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function index()
    {
    	$rootFolders = Root::all();

    	return view('admin.rootFolders.index', compact('rootFolders'));
    }

    public function create()
    {
    	return view('admin.rootFolders.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' 			=>	'required|string',
    		'description' 	=>	'required|string',
            'image'         =>  'file|max:25600'
    	]);

    	$image = $request->file('image');
        
    	$rootFolder = new Root;

        $rootFolder->admin_id           =   Auth::user()->id;
    	$rootFolder->name 			    =	$request->input('name');
    	$rootFolder->description 	    =	$request->input('description');
    	$rootFolder->image 				=	$image->getClientOriginalName();
    	$rootFolder->image_path			=	$image->store('public/storage');

    	$rootFolder->save();

    	session()->flash('message', 'Folder created successfully !');

    	return redirect('/admin/root');
    }

    public function show($id)
    {
    	$rootFolder = Root::findOrFail($id);

    	return view('admin.rootFolders.show', compact('rootFolder'));
    }

    public function edit($id)
    {
    	$rootFolder = Root::findOrFail($id);

    	return view('admin.rootFolders.edit', compact('rootFolder'));
    }

    public function update($id, Request $request)
    {
        if($request->has('image'))
        {
            $this->validate($request, [
                'name'          =>  'required|string',
                'description'   =>  'required|string',
                'image'         =>  'file|max:25600'
            ]);

            $file = $request->file('image');

            Root::where('id', '=', $id)->update([
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'image'         =>  $file->getClientOriginalName(),
                'image_path'    =>  $file->store('/public/storage')
            ]);

            session()->flash('message', 'Changes made successfully !');

            return $this->index();
        }

    	$this->validate($request, [
    		'name' 			=>	'required|string',
    		'description' 	=>	'required|string',
    	]);

        Root::where('id', '=', $id)->update([
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description'),
        ]);

        session()->flash('message', 'Changes made successfully !');

        return $this->index();
    }

    public function destroy($id)
    {
    	$rootFolder = Root::findOrFail($id);

    	$rootFolder->delete();
    	$rootFolder->folders()->delete();

    	session()->flash('message', 'Folder deleted successfully !');

    	return redirect('/admin/root');
    }
}
