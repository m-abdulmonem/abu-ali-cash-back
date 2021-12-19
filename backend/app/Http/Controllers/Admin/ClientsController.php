<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (user_can("view clients"))
            return view("admin.clients.index",[
                'title' => trans("users.clients_title"),
                'users' => Client::all()
            ]);
        return back()->with("access_denied", trans("home.access_denied"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  redirect(admin_url("clients"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return  redirect(admin_url("clients"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //with("balances")->with("VipCards")
        if (user_can("view client")){
            if ($user = Client::where("username",$id)->first()){
                return view("admin.clients.view",[
                    'user'=>$user,
                    'title' => trans("users.view_client_title")
                ]);
            }
            return back()->with("error","users.error");
        }
        return back()->with("access_denied", trans("home.access_denied"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //with("balances")->with("VipCards")-
        if (user_can("edit client")){
            if ($user = Client::where("username",$id)->first()){
                return view("admin.clients.view",[
                    'user'=>$user,
                    'title' => trans("users.edit_client_title")
                ]);
            }
            return back()->with("error","users.error");
        }
        return back()->with("access_denied", trans("home.access_denied"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //with("balances")->with("VipCards")->
        if ($user = Client::find($id)){
            $user->update([
                'account_type' => request("account_type"),
                'status' => request("status"),
            ]);
            return back()->with("success",trans("users.success_update"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (user_can("delete client")){
            if ($user = Client::find($id)) {
                $user->delete();
                return json(null,1,trans("users.client_delete_success"));
            }
        }
        return json("",403,trans("access_denied"));
    }
}
