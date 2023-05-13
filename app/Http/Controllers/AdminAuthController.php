<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    //
    public function adminSignup(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'email'=>'required',
            'password' => 'required|min:8|confirmed',

        ]);
        $admin = new admin;
        $admin->name=$req->name;
        $admin->email=$req->email;
        $admin->password = bcrypt($req->password);
        $admin->save();
    }


    public function login(Request $request)
{
    $admin = Admin::where('email', $request->email)->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        // Authentication successful
        return redirect('adminDashboard');


    } else {
        // Authentication failed
        // return back()->withErrors(['email' => 'Invalid email or password']);
        echo "Login failed";
    }
}

public function logout()
{
    Auth::guard('admin')->logout();
    return redirect(route('admin.login'));
}


}
