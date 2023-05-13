<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'email'=>'required',
            'password' => 'required|min:8|confirmed',

        ]);
        $member = new member;
        $member->name=$req->name;
        $member->email=$req->email;
        $member->password = bcrypt($req->password);
        $member->save();
    }

public function login(Request $request)
{
    $member = Member::where('email', $request->email)->first();

    if ($member && Hash::check($request->password, $member->password)) {
        // Authentication successful
        return redirect('/dashboard');

    } else {
        // Authentication failed
        // return back()->withErrors(['email' => 'Invalid email or password']);
        echo "Login failed";
    }
}

}
