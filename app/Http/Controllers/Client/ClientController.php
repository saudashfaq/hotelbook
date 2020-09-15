<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAddVenuesRequest;
use App\Http\Requests\CreateMenuItemsRequest;
use App\Http\Requests\CreateMenuPriceRequest;
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
    public function storemenuitemsprice(CreateMenuPriceRequest $request)
    {
        $menuItemsRate = [
            'label' => $request->menu_rates_label,
            'user_account_id' => Auth::user()->user_account_id,
            'user_id' => Auth::user()->id,
            'menu_item_id' => $request->menu_item_type_id,
            'menu_quantity_type' => $request->menu_item_quantity_type,
            'quantity' => $request->menu_item_quantity,
            'price' => $request->menu_items_price
        ];
        // dd($menuItemsRate);
        Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id)->menuItemsRate()->create($menuItemsRate);
        return redirect()->back();
    }
    public function adduser()
    {
        return view('Client.dashboard.adduser');
    }
    public function addvenues()
    {

        return view('Client.dashboard.addvenues');
    }
    public function menuitems()
    {
        $menus = Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id)->menuItems()->get();
        return view('client.dashboard.menuitems', ['menus' => $menus]);
    }
    public function addmenuitems()
    {
        return view('client.dashboard.addmenuitems');
    }
    public function menupackage()
    {
        $menuPackage = Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id)->menuPackageRate()->get();
        return view('client.dashboard.menupackage', ['menuPackage' => $menuPackage]);
    }
    public function addmenupackage()
    {
        $menus = Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id)->menuItems()->get();
        return view('client.dashboard.addmenupackage', ['menus' => $menus]);
    }
    public function storemenupackage(Request $request)
    {
        $menu_packages_rate = [
            'user_account_id' => Auth::user()->user_account_id,
            'user_id' => Auth::user()->id,
            'price' => $request->menu_items_package_price,
            'descrtiption' => $request->menu_package_description,
        ];
        $stored_menu_packages_rate = Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id)->menuPackageRate()->create($menu_packages_rate);
        $menu_package_rate_bridge = [
            'menu_item_id' => $request->menu_item_id,
            'user_menu_packages_with_rate_id' => $stored_menu_packages_rate->id,
            'menu_quantity_type_id' => $request->menu_item_package_quantity_type,
            'quantity' => $request->menu_package_item_quantity,
        ];
        Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id)->menuPackageRateBridge()->create($menu_package_rate_bridge);
        return ('saved');
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
    public function storemenuitems(CreateMenuItemsRequest $request)
    {
        $menu_items = [
            'user_account_id' => Auth::user()->user_account_id,
            'menu_type_id' => $request->menu_item_type_id,
            'name' => $request->menu_item_name,
            'status' => $request->menu_item_status,
        ];
        $added_menu_item = Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id)->menuItems()->create($menu_items);
        $menuItemsRate = [
            'label' => $request->menu_rates_label,
            'user_account_id' => Auth::user()->user_account_id,
            'user_id' => Auth::user()->id,
            'menu_item_id' => $added_menu_item->id,
            'menu_quantity_type' => $request->menu_item_quantity_type,
            'quantity' => $request->menu_item_quantity,
            'price' => $request->menu_items_price
        ];
        // dd($menuItemsRate);
        Auth::user()->userAccount->findOrFail(Auth::user()->user_account_id)->menuItemsRate()->create($menuItemsRate);
        return redirect()->back;
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
