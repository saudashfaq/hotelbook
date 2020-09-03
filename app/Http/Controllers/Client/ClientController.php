<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddVenuesRequest;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\UserAccount;
use App\User;
use App\Models\Venues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ClientController extends Controller
{
    public function users()
    {
        $id = Auth::user()->id;
        $users = User::all()->where('parent_id', $id);
        return view('Client.dashboard.users', ['users' => $users]);
    }
    public function adduser()
    {
        return view('Client.dashboard.adduser');
    }
    public function addvenues()
    {

        return view('Client.dashboard.addvenues');
    }
    public function venues()
    {
        $user_account_id = Auth::user()->user_account_id;
        $venues = Venues::all()->where('user_account_id', $user_account_id);
        return view('Client.dashboard.venues', ['venues' => $venues]);
    }
    public function editprofile()
    {
        $data = Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id);
        return view('client.dashboard.editprofile', ['user_account' => $data]);
    }
    public function storeprofile(CreateProfileRequest $request)
    {
        $userAccount = [
            'business_type' => $request->bussiness_type,
            'opens_at' => $request->opens_at,
            'closes_at' => $request->closes_at,
            'day_type' => json_encode($request->days)
        ];
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id)->update($userAccount);
        return ('Profile Updated');
    }
    public function storevenues(CreateAddVenuesRequest $request)
    {
        $venues = [
            'user_account_id' => Auth::user()->user_account_id,
            'user_id' => Auth::user()->id,
            'venue_name' => $request->venue_name,
            'venue_type_id' => $request->venue_type,
            'min_guests' => $request->min_guests,
            'max_guests' => $request->max_guests,
            'day_type' => json_encode($request->days),
            'uses_time_slots' => json_encode($request->available_time),
            'max_occupied_time_length' => $request->max_occupied_time
        ];
        Venues::create($venues);
    }
    public function store(CreateUserRequest $request)
    {
        $parent_id = Auth::user()->id;
        $userAccount = new UserAccount();
        $user = [
            'parent_id' => $parent_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $userAccount->user()->create($user);
        return redirect('dashboard/adduser');
    }
}
