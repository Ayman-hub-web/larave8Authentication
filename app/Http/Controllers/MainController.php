<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:5|max:12',
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->route('home');

    }

    public function makeLogin(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required|min:5|max:12',
        // ]);

        $data = array(
            'email' => $request->email,
            'password' => $request->password
        );

        $admin = Admin::where('email', $request->email)->first();

        if(!$admin)
        {
            return back()->with('error', 'email is invalid');
        }
        else
        {
            if(Hash::check($request->password, $admin->password))
            {
                $request->session()->put('loggedUser', $admin->id);
                return redirect()->route('home');
            }
            else
            {
                return back()->with('error', 'password is invalid');
            }
        }
    }

    public function home()
    {
        $data = ['loggedUserInfo'=>Admin::where('id', session('loggedUser'))->first()];
        return view('home', $data);
    }

    public function logout()
    {
        if(session()->has('loggedUser'))
        {
            session()->pull('loggedUser');
            return redirect()->route('auth.login');
        }

    }
}

