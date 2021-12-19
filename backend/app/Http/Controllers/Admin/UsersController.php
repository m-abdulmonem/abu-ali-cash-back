<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InviteUser;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("admin.users.index",[
            'title' => trans("users.title"),
            'users' => User::where("id","!=",1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create",[
            'title' => trans("users.create_title"),
            'roles' => old("role_id")
                ? Role::with("permissions")->where("id","!=",old("role_id"))->get()
                : Role::with("permissions")->get()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {

        $data = $this->validate(request(),[
            'name' => 'sometimes|nullable|string',
            'username' => 'sometimes|nullable|string|unique:users' ,
            'email' => 'required|email|unique:users',
            'phone' => 'sometimes|nullable|numeric',
            'account_type' => 'required|string',
            'status' => 'required|string',
        ]);

        $data['picture'] = image('picture');

        $user = User::create($data);

        $user->syncRoles(explode(",",request("roles")));
        $user->syncPermissions(explode(",",request("permissions")));
        $token = app('auth.password.broker')->createToken($user);
        Mail::to($user->email)->send(new InviteUser(["user" => $user,'token' => $token]));
        return back()->with("success", trans("users.success_create"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(admin_url("users"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       if ($id > 1){
           if ($user = User::with("roles")->with("permissions")->find($id)){
               return view("admin.users.update",[
                   'title' => trans("users.edit_title"),
                   'admin'=> $user,
                   'roles' => Role::where("name" ,"!=", get_role_name($user) )
               ]);
           }
           return redirect(admin_url("users"));
       }
       return redirect(admin_url("users"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id)
    {
        if ($admin = User::find($id)){
            $data = $this->validate(request(),[
                'account_type' => 'required|string',
                'status' => 'required|string',
            ]);

            $admin->syncRoles(explode(",",request("roles")));
            $admin->syncPermissions(explode(",",request("permissions")));

            $admin->update($data);
            return back()->with("success", trans("users.success_create"));
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
        if ($id !== 1 && $user = User::find($id)){
            $user->delete();
            return json("",1, trans("users.success_delete"));
        }
        return  json("",0,trans("users.not_founded"));
    }


    private function send_mail($mail, $data = [], $receiver = [])
    {
        Mail::send($mail, $data, function($message) {

            $message->to('tutsmake@gmail.com', 'Receiver Name')
                ->subject('Tuts Make Mail');
        });

        return Mail::failures();
    }
}
