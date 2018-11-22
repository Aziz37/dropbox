<?php

namespace App\Http\Controllers\User;

use App\Models\Root;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.home');
    }

    public function explore()
    {
    	$rootFolders = Root::get();

    	return view('users.explore', compact('rootFolders'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.profile', compact('user'));
    }

    public function update($id, Request $request)
    {
        if($request->has('password'))
        {
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed'
            ]);

            $user = User::findOrFail($id);

            if(!Hash::check($request->input('current_password'), $user->password))
            {
                session()->flash('message', 'CURRENT PASSWORD IS INCORRECT ! Please try again');
                return redirect()->back();
            }

            User::where('id', '=', $id)->update([
                'password' => Hash::make($request->input('password'))
            ]);

            session()->flash('message', 'Password Changed Successfully !');

            return redirect()->action('Auth\LoginController@userLogout');
        }

        $this->validate($request, [
            'user_type' =>  'required|string|max:255',
            'email'     =>  'required|string|email|max:255',
            'department'=>  'required|string|max:255'
        ]);
        
        User::where('id', $id)->update([
            'user_type' =>  $request->input('user_type'),
            'email'     =>  $request->input('email'),
            'department'=>  $request->input('department')
        ]);

        session()->flash('message', 'User Details Changed Successfully !');

        return $this->edit($id);
    }
}
