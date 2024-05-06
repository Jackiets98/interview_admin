<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $userId = Auth::id();

        $userFirstName = DB::table('admins')
        ->pluck('first_name')
        ->first();

        $userLastName = DB::table('admins')
        ->pluck('last_name')
        ->first();

        $totalOrder = DB::table('delivery')
        ->count();

        return view('homepage', compact('userFirstName','userLastName', 'totalOrder'));
    }

    public function myProfile() {

        $userId = Auth::id();

        $userFirstName = DB::table('admins')
        ->pluck('first_name')
        ->first();

        $userLastName = DB::table('admins')
        ->pluck('last_name')
        ->first();

        $adminDetails = DB::table('admins')
        ->where('id',"=", $userId)
        ->select('*')
        ->get();

        return view('Auth.profile', compact('userFirstName','userLastName','adminDetails'));
    }

    public function updateProfile($id, Request $request) {

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $email = $request->input('email');
        $password = $request->input('password');

        if($password != "") {
            DB::table('admins')
            ->where('id', $id)
            ->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => Hash::make($password),
                'updated_at' => now()
            ]);
        }else{
            DB::table('admins')
            ->where('admins.id', $id)
            ->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'updated_at' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Profile is updated successfully!');
    }
}
