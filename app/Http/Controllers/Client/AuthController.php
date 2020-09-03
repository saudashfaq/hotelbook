<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UserAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('Client.register');
    }
    public function dashboard()
    {
        return view('Client.dashboard.dashboard');
    }
    public function store(Request $request)
    {
        $userAccount = UserAccount::create([
            'business_type' => $request->bussiness_type,
            'opens_at' => $request->opens_at,
            'closes_at' => $request->closes_at,
            'day_type' => json_encode($request->day_type)
        ]);
        $user = [
            'user_account_id' => $userAccount->id,
            'parent_id' => 0,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $userAccount->user()->create($user);
        $userAccount->save();
        return ('you are Successfully Created');
    }
    protected function getData(Request $request)
    {
        $rules = [
            'business_type' => 'required',
            'opens_at' => 'required',
            'closes_at' => 'required',
            'password' => 'required|confirmed'
        ];

        $data = $request->validate($rules);
        return $data;
    }
}
