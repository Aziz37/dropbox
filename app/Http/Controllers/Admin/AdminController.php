<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

    public function index()
    {
        return view('admin.home');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.profile', compact('admin'));
    }

    public function update($id, Request $request)
    {
        if($request->has('password'))
        {
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed'
            ]);

            $admin = Admin::findOrFail($id);

            if(!Hash::check($request->input('current_password'), $admin->password))
            {
            	session()->flash('message', 'CURRENT PASSWORD IS INCORRECT ! Please try again');
            	return redirect()->back();
            }

            Admin::where('id', '=', $id)->update([
                'password' => Hash::make($request->input('password'))
            ]);

            session()->flash('message', 'Password Changed Successfully !');

            return $this->edit($id);
        }

        $this->validate($request, [
            'email'     =>  'required|string|email|max:255',
            'department'=>	'required|string|max:255'
        ]);
        
        Admin::where('id', $id)->update([
            'email'     =>  $request->input('email')
        ]);

        session()->flash('message', 'Admin Details Changed Successfully !');

        return $this->edit($id);
    }
}
