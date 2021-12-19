<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashBack;
use App\Models\Category;
use App\Models\Client;
use App\Models\Offer;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{


    public function index()
    {

        return view("admin.dashboard.index",[
            'title' => trans("home.title"),
            'offers' => Offer::with("category")->paginate(settings("paginate"))
        ]);
    }



    public function profile()
    {
        if (admin()->check()){
            return view("admin.dashboard.profile",[
                'title' => trans("home.profile_edit"),
            ]);
        }
    }
    public function profile_Save()
    {
        $data = $this->validate(request(),[
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username,' . profile("id"),
            'email' => 'required|email|unique:users,email,' . profile("id"),
            'phone' => 'sometimes|nullable|numeric'
        ]);
        $data['picture'] = image("picture",false,profile("picture"));

        profile(null,true)->update($data);
        return back()->with("success", trans("home.profile_updated"));
    }


    public function password_save()
    {
        $data = $this->validate(request(),[
            'password' => 'required|string|confirmed|min:8',
        ]);
        $data['password'] = Hash::make(request("password"));
        profile(null,true)->update($data);
        return back()->with("password_updated", trans("home.profile_updated"));
    }

    public function error_404()
    {
        return view("admin.layouts.errors.404",[
            'title' => trans("home.404")
        ]);
    }


    public function search()
    {
        $title = trans("home.search_about") .' "' . request("keyword") .'"';
        if (request()->has("keyword")){
            $keyword = request("keyword");
            $compact = null;
            if (profile(null,true)->hasAnyRole(["super-admin","admin"])){
                $clients = Client::where("name", "LIKE", "%$keyword%")
                    ->orWhere("username", "LIKE", "%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("phone", "LIKE", "%$keyword%")
                    ->orWhere("account_type", "LIKE", "%$keyword%")
                    ->orWhere("country", "LIKE", "%$keyword%")
                    ->orWhere("status", "LIKE", "%$keyword%")->get();
            }
            if (profile(null,true)->hasRole("super-admin")){
                $users = User::where("name", "LIKE", "%$keyword%")
                    ->orWhere("username", "LIKE", "%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("phone", "LIKE", "%$keyword%")
                    ->orWhere("account_type", "LIKE", "%$keyword%")
                    ->orWhere("status", "LIKE", "%$keyword%")->get();
                $roles = Role::where("name", "LIKE", "%$keyword%")
                    ->orWhere("name_ar", "LIKE", "%$keyword%")->get();
                $permissions = Permission::where("name", "LIKE", "%$keyword%")
                    ->orWhere("name_ar", "LIKE", "%$keyword%")->get();
            }
            if (profile(null,true)->hasAnyRole(['super-admin','admin','writer'])) {
                $categories = Category::where("name", "LIKE", "%$keyword%")
                    ->orWhere("name_ar", "LIKE", "%$keyword%")
                    ->orWhere("details", "LIKE", "%$keyword%")->get();
                $offers = Offer::where("company_name" ,"LIKE" ,"%$keyword%")
                    ->orWhere("coupon_code" ,"LIKE" ,"%$keyword%")
                    ->orWhere("vip_reward" ,"LIKE" ,"%$keyword%")
                    ->orWhere("reward" ,"LIKE" ,"%$keyword%")
                    ->orWhere("exceptions" ,"LIKE" ,"%$keyword%")
                    ->orWhere("about_store" ,"LIKE" ,"%$keyword%")->get();
                $cash_backs = CashBack::where("title","LIKE","%$keyword%")
                    ->orWhere("vip_reward" ,"LIKE" ,"%$keyword%")
                    ->orWhere("reward" ,"LIKE" ,"%$keyword%")->get();
            }


            if (profile(null,true)->hasRole("super-admin"))
                $compact = compact("title","categories","offers","cash_backs","users","roles","permissions","clients");
            if (profile(null,true)->hasRole("admin"))
                $compact = compact("title","categories","offers","cash_backs","clients");
            if(profile(null,true)->hasRole("writer"))
                $compact = compact("title","categories","offers","cash_backs");

            return view("admin.dashboard.search",$compact);
        }
        return view("admin.dashboard.search",compact('title'));
    }

    public function visitors()
    {
        $visitors = Visitor::countByCountry(request("region"));
        return json($visitors,1, "<span class='font-weight-bold font'>$visitors</span> " . trans("home.visitors"));
    }
}
