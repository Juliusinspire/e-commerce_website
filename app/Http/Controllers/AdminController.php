<?php

namespace App\Http\Controllers;
use App\Models\member;
use App\Models\Admin;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Nette\MemberAccessException;

class AdminController extends Controller
{
    //
    public function dashboard()
{
    $members = Member::all(); // fetch all members

    return view('adminDashboard', [
        'members' => $members,
    ]);
}


}
