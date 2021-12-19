<?php


Route::group(['middleware' => 'auth'],function (){

    Route::get("/","DashboardController@index")->middleware(['role:super-admin|admin|writer']);
    Route::get("/404","DashboardController@error_404");
    Route::get("/500","DashboardController@error_500");
    Route::get("/search/all","DashboardController@search");
    Route::get("/visitors","DashboardController@visitors")->middleware("role:super-admin");
    /*
     * Roles
     */
    Route::resource("roles","RolesController")->middleware(["role:super-admin"])->except(['create',"show","update","edit","store"]);
    /*
     * Permissions
     */
    Route::resource("permissions","PermissionsController")->middleware(["role:super-admin"])->except(['create',"show","update","edit","store"]);
    /*
     * users
     */
    Route::resource("users","UsersController")->middleware(['role:super-admin']);
    /*
     * profile
     */
    Route::get("profile","DashboardController@profile");
    Route::get("profile/edit","DashboardController@profile");
    Route::put("profile/edit","DashboardController@profile_save");
    Route::put('profile/password/edit',"DashboardController@password_save");
    /*
     * offers
     */
    Route::resource("offers","OffersController")->middleware(['role:super-admin|admin|writer'])->except(['index']);
    Route::get("offers","OffersController@index");
    Route::get("offers/{category?}/category","OffersController@index");
    /*
     * categories
     */
    Route::resource("categories","CategoriesController")->middleware(['role:super-admin|admin|writer']);
    /*
    * CashBack
    */
    Route::resource("cash-back","CashBackController")->middleware(['role:super-admin|admin|writer']);
    /*
     * Clients
     */
    Route::resource("clients","ClientsController")->middleware(['role:super-admin|admin']);
    /*
     * Settings
     */
    Route::get("settings/main","SettingsController@index")->middleware(["role:super-admin|admin"]);
    Route::get("settings","SettingsController@index")->middleware(["role:super-admin|admin"]);
    Route::put("settings/main-info","SettingsController@main_info")->middleware(["role:super-admin","permission:edit site settings"]);
    Route::put("settings/mobile-apps","SettingsController@apps_save")->middleware(["role:super-admin|admin","permission:	edit mobile app links"]);
    Route::put("settings/social-media","SettingsController@social_media")->middleware(["role:super-admin|admin","permission:edit social links"]);
    Route::put("settings/maintenance","SettingsController@maintenance")->middleware(["role:super-admin|admin", 'permission:edit site maintenance']);

});
