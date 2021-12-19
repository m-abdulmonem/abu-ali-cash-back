<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.dashboard.settings",[
            'title' => trans("settings.Main_Title"),
        ]);
    }


    /**
     *
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function apps_save()
    {
        $data = $this->validate(request(),[
            'android_app_link' => 'sometimes|nullable|string|url',
            'ios_app_link' => 'sometimes|nullable|string|url',
        ]);
        return settings(false,true,$data)
            ? back()->with("success", trans("settings.Success_update_apps"))
            : back()->with("error", trans("Error_update"));
    }

    public function main_info()
    {

        $data = $this->validate(request(),[
            'site_name_ar' => 'required',
            'site_name_en' => 'required',
            'logo' => 'sometimes|nullable',
            'icon' => 'sometimes|nullable',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|numeric',
            'description' => 'sometimes|nullable',
            'keywords' => 'sometimes|nullable',
            'status' => 'sometimes|nullable|in:open,close',
            'paginate' => 'integer',
        ]);
        $data['icon'] = image('icon',false,settings('icon'));
        $data['logo'] = image('logo',false,settings('logo'));
        return settings(false,true,$data)
            ? back()->with('success',trans("settings.Main_info_success_update"))
            : back()->with('error', trans("settings.Error_update"));
    }


    public function social_media()
    {
        $data = $this->validate(request(),[
            'fb' => 'sometimes|nullable',
            'tw'=> 'sometimes|nullable',
        ]);
        return settings(false,true,$data)
            ? back()->with('success',trans("settings.Success_update_social_media"))
            : back()->with('error','عفوا هناك خطأ');
    }

    public function maintenance()
    {
        $data = $this->validate(request(),[
            'maintenance_start_at' => 'required|before:today',
            'maintenance_end_at' => 'required|after:today',
            'maintenance_message' => 'required|string'
        ]);
        return settings(false,true,$data)
            ? back()->with("success",trans("settings.Success_update_maintenance"))
            : back()->with("error", trans("settings.Error_update"));
    }
}
