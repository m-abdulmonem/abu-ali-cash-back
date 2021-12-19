<?php



/*
 *  admin side  main url
 *
 */

use App\Models\Setting;

if (!function_exists('admin_url')){

    /**
     * get admin [urls]
     *
     * @param string $url
     * @return UrlGenerator|string
     */
    function admin_url($url = '/'){
        return url('ma-admin/' . trim($url,'/'));
    }
}


/*
 *  admin side  main url
 *
 */
if (!function_exists('admin_assets')){

    /**
     * get admin style files [urls]
     *
     * @param string $url
     * @return UrlGenerator|string
     */
    function admin_assets($url = '/'){
        return asset('admin/' . trim($url,'/'));
    }
}


/*
 *
 *
 */
if (!function_exists("admin")){
    /**
     * For Admin Middleware
     * @return void
     */
    function admin(){
        return auth()->guard();
    }

}

/*
 *
 *
 */
if (!function_exists("profile")){
    /**
     * For Admin Middleware
     * @param $property
     * @param bool $update
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    function profile($property = null,$update = false){
        if ($update)
            return auth()->user();
        return (auth()->check())
            ? auth()->user()->$property
            : null;
    }
}

if (! function_exists("user_can")){

    function user_can($permissions,$all =null){
        if ($all)
            return profile(null,true)->hasAllPermissions($permissions);
        if (!is_array($permissions))
            return profile(null,true)->can($permissions);
        return profile(null,true)->hasAnyPermission($permissions);
    }
}


// filter functions

/***
 * check valid email
 *
 */
if (! function_exists("is_email")){

    /**
     *
     * @param string $email
     * @return mixed
     */
    function is_email(string $email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}


/*
 *
 */
if (! function_exists('controllers_trans')){

    /**
     * Get Controller Arabic Name
     *
     * @param $key
     * @return mixed
     */
    function controllers_trans($key){
        $trans = [
            '/' => trans("home.title"),
            'reports'=> trans("reports.title"),
            'contact-messages'=> trans("mail.title"),
            'settings'=> trans("settings.title"),
            'users'=> trans("users.title"),
            'user'=> trans("users.user"),
            'clients'=> trans("users.clients_title"),
            'categories'=> trans("categories.title"),
            'roles' => trans("roles.title"),
            'permissions' => trans("roles.permission_title"),
            'offers' => trans("offers.title"),
            'cash-back' => trans("offers.cash_back_title"),
            'profile' => trans("home.profile"),
            '404' => trans("home.404"),
            '500' => trans("home.500"),
            '403' => trans("home.403"),
            'search' => trans("home.search")
        ];
        return array_key_exists($key,$trans)
            ? $trans[$key]
            : null;
    }
}

if (! function_exists('get_breadcrumb')){

    /**
     * Get [Breadcrumb]
     *
     * @param int $key
     * @param int $second
     * @param null $title
     * @return string
     */
    function get_breadcrumb($key = 2,$second = 3,$title = null){
        if (request()->segment($key))
            echo  '<li class="breadcrumb-item active"><a href="' . admin_url('/') . '">' .  controllers_trans('/') . ' </a></li>';
        if (request()->segment($second)){
            $html = '<li class="breadcrumb-item"><a href="' . admin_url(request()->segment($key) !== "search" ?request()->segment(2) : "/search/all" ) . '"> ' .  controllers_trans(request()->segment($key)) . '</a></li>';
            return $html .=  "<li class='breadcrumb-item active'>$title</li>";
        }
        return  '<li class="breadcrumb-item active">' .  controllers_trans((request()->segment($key) ? request()->segment($key) : '/')) . '</li>';
    };
}

if ( !function_exists("json") ){

    /**
     * print data in json format
     *
     * @param mixed $data
     * @param null $status
     * @param null $msg
     * @param null $headers
     * @return \Illuminate\Http\JsonResponse
     */
    function json($data, $status = null,$msg = null,$headers = null){
        return ( $status >= 0 or $msg )
            ? response()->json(['data' => $data, 'msg' => $msg , 'status' => $status  ])
            : response()->json(['data' => $data]);
    }
};


if (!function_exists('settings')){

    /**
     * get site [Settings]
     *
     * @param $property
     * @param bool $action
     * @param array $data
     * @return mixed
     */
    function settings($property = null, $action = false,$data = []){
        $settings = Setting::orderBy('id','DESC')->first();
        if ($action)
            return $settings
                ? $settings->update($data)
                : Setting::create($data);
        return $settings ? Setting::orderBy('id','DESC')->first()->$property : false;
    }
}

if (! function_exists("get_img")){

    /**
     * Get Img Link
     *
     * @param $img_name
     * @return string
     */
    function get_img($img_name){
        return "$img_name";
    }
}


if (! function_exists('image')){

    /**
     * Store Images Or Files to Server
     * get Save [Image] or [file] by file name
     * get old [image] when update
     *
     *
     * @param $name
     * @param bool $get_img
     * @param null $update
     * @param string $folder_name
     * @return string|UrlGenerator
     */
    function image($name,$get_img = false,$update = null,$folder_name = 'images'){
        if (!request()->hasFile($name) && $update)
            return $update;
        if (request()->hasFile($name) && !$get_img){
            request()->validate([
                $name => 'image|mimes:jpeg,png,jpg,gif|max:6000'
            ]);
            return request()->file($name)->store($folder_name,'public');
        }
        if ($get_img){
            return (strpos($name, 'images') !== false || strpos($name, 'companies_logo') !== false)
                ? asset('storage/' . $name)
                : admin_assets("img/MAAdminLogo.png");
        }
    }
}


if (! function_exists('list_options')){

    /**
     * List Select Options
     * Remove old index from options
     *
     * @param array $options
     * @param null $old_option
     * @param bool $key
     */
    function list_options($options = [],$old_option = null,$key = false){
        if (array_key_exists("default",$options))
            echo "<option>" . $options['default'] . "</option>";
        unset($options['default']);

        if (in_array($old_option,$options)){
            unset($options[$old_option]);
        }
        if (in_array($old_option,$options)){
            echo "<option value='$old_option' selected>$key</option> ";
            foreach ($options as $key => $value)
                echo $key?  "<option value='$key'>$value</option>" :  "<option value='$value'>$value</option> ";
        }
        foreach ($options as $key => $value)
            echo $key ?  "<option value='$key'>$value</option>" :  "<option value='$value'>$value</option> ";
    }
}

if (!function_exists('settings')){

    /**
     * get site [Settings]
     *
     * @param $property
     * @param bool $action
     * @param array $data
     * @return mixed
     */
    function settings($property = null, $action = false,$data = []){
        $settings = Setting::orderBy('id','DESC')->first();
        if ($action)
            return $settings
                ? $settings->update($data)
                : Setting::create($data);
        return $settings ? Setting::orderBy('id','DESC')->first()->$property : false;
    }
}

if (! function_exists('get_role_name')){

    /**
     * get User Role Name
     * @param $user
     * @return mixed
     */
    function get_role_name($user){
        return str_replace(['[','"','"',']'],'',$user->getRoleNames());
    }
}

if (! function_exists("get_permissions")){

    function get_permissions($permissions){
        foreach ($permissions as $permission){
            echo "$permission->name,";
        }
    }
}

if (! function_exists("get_roles")){

    function get_roles($roles){
        foreach ($roles as $role){
            echo "$role->name,";
        }
    }
}

if (! function_exists('lang')){
    /**
     * Get Client Language
     *
     * @param $guard
     * @param null $lang_check
     * @param bool $set_session
     * @return string
     */
    function lang($guard ,$lang_check = null,$set_session = false){
        if ($lang_check)
            return ($guard->check() && $lang = $guard->user()->lang)
                ? ($lang == $lang_check) ? true: false : false;
        if ($set_session)
            return  session()->has('lang') ? session('lang') : 'en';
        return ($guard->check() && $lang = $guard->user()->lang) ? $lang : 'en';
    }
}

if (! function_exists("admin_lang")){

    /**
     * @param null $lang_check
     * @param bool $set_session
     * @return string
     */
    function admin_login($lang_check = null,$set_session = false){
        return lang(admin(),$lang_check,$set_session);
    }
}


if (! function_exists("datatable_files")){
    /**
     * get datatable js files
     *
     * @param string $file_type
     * @param string $selector
     * @return string
     */
    function datatable_files($file_type = "js",$selector = "ma-admin-datatable"){
        if ($file_type != "js")
            return '<!-- DataTables -->
                <link rel="stylesheet" href="' . admin_assets("/css/dataTables.bootstrap4.min.css") . '">';

        echo '  <!-- DataTables -->
        <script src="' . admin_assets("/js/jquery.dataTables.min.js") . '"></script>
        <script src="' . admin_assets("/js/dataTables.bootstrap4.min.js") . '"></script>';

        if (is_array($selector)){
            echo "<script>";
            foreach ($selector as $select)
                echo "$('#$select').DataTable();";
            echo "</script>";
        }else
            echo "<script>$('#$selector').DataTable()</script>";
    }
}


if (! function_exists('active_class')){

    /**
     * Add [Open Menu] Classes And [Active] Classes To links
     *
     * @param $page
     * @param $class
     * @param $option
     */
    function active_class($page,$class,$option = null){
        if (is_array($page)){
            foreach ($page as  $link){
                simple_active_class($link,$class,$option);
            }
        }
        simple_active_class($page,$class,$option);
    }
}
if (! function_exists('simple_active_class')) {

    /**
     * Continue Active Class Function
     *
     * @param $link
     * @param $class
     * @param $option
     */
    function simple_active_class($link,$class,$option = null){
        if ($link !== '/'){
            if($link === request()->segment(2)){
                echo  (request()->segment(3) && $option === request()->segment(3))
                    ? 'active'
                    : ['menu-open','active'][$class];
            }
            echo ['',''][$class];
        }
    }
}
if (! function_exists('home_active_class')){

    /**
     * Get ['Active'] and ['menu-open'] class for home menu
     *
     * @param $class
     * @return mixed
     */
    function home_active_class($class){
        return (request()->segment(1) == 'ma-admin' && request()->segment(2) === null)
            ? ['menu-open','active'][$class]
            : ['',''][$class];
    }
}

if (! function_exists("super_unique")){
    /**
     * Removes duplicate values from an multidimensional array
     *
     *
     * @param $array
     * @param $key
     * @return array
     */
    function super_unique($array,$key){
        $temp_array = [];
        foreach ($array as &$v) {
            if (!isset($temp_array[$v[$key]]))
                $temp_array[$v[$key]] =& $v;
        }
        $array = array_values($temp_array);
        return $array;
    }
}
