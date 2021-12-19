@extends("admin.layouts.index")
@section("content")

    @push("css")
        <link rel="stylesheet" href="{{ admin_assets('/css/amsify.suggestags.css') }}">
    @endpush
    <form action="{{ route("users.update",$admin->id) }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-9">
                @csrf
                @method("PUT")
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans("home.save") }}</button>
                        <a class="btn btn-success" href="{{ admin_url("users/create") }}"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                        <div class="btn btn-danger btn-delete float-right"
                             data-url="{{ admin_url("user/$admin->id/delete") }}"
                             data-name="{{ $admin->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i> {{ trans("home.delete") }}</div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex">
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="name">{{ trans("users.name") }}</label>
                                    <input type="text" class="form-control" id="name" placeholder="{{ trans("users.name") }}" name="name" value="{{ old("name") ? old('name') : $admin->name  }}" disabled>
                                </div>
                            </div>
                            <!-- ./col-6 -->
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="username">{{ trans("users.username") }}</label>
                                    <input type="text" class="form-control" id="username" placeholder="{{ trans("users.username") }}" name="username" value="{{ old("username") ? old("username") : $admin->username }}" disabled>
                                </div>
                            </div>
                            <!-- ./col-6 -->
                        </div>
                        <!-- ./d-flex -->
                        <div class="d-flex">
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="email">{{ trans("users.email") }}</label>
                                    <input type="text" class="form-control" id="email" placeholder="{{ trans("users.email") }}" name="email" value="{{ old("email") ?old("email") :$admin->email }}" disabled>
                                </div>
                            </div>
                            <!-- ./col-6 -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">{{ trans("users.phone") }}</label>
                                    <input type="text" class="form-control" id="phone" placeholder="{{ trans("users.phone") }}" name="phone" value="{{ old("phone") ?old("phone") :$admin->phone }}" disabled>
                                </div>
                            </div>
                            <!-- ./col-6 -->

                        </div>
                        <!-- ./col-12 -->
                        <div class="d-flex">
                            <!-- ./col-4 -->
                            <div class="col-4">
                                <div class="form-group ">
                                    <label for="roles">{{ trans("roles.select_role") }}</label>
                                    <input class="form-control" name="roles" value="{{ old('roles') ? old("roles") : get_roles($admin->roles) }}"
                                           placeholder="{{ trans("roles.select_role") }}" id="roles" data-role="tagsinput" >
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group ">
                                    <label for="account_type">{{ trans("users.select_account_type") }}</label>
                                    <select name="account_type" id="account_type" class="form-control">
                                        @if($admin->account_type == "vip" || old("account_type") || old("account_type") == "vip" )
                                            <option value="vip" selected>{{ trans("home.vip") }}</option>
                                            <option value="basic">{{ trans("home.basic") }}</option>
                                        @else
                                            <option value="basic" selected>{{ trans("home.basic") }}</option>
                                            <option value="vip" >{{ trans("home.vip") }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <!-- ./col-4 -->
                            <div class="col-4">
                                <div class="form-group ">
                                    <label for="status">{{ trans("users.select_status") }}</label>
                                    <select name="status" id="status" class="form-control">

                                        @if($admin->status == "active" || old("status") || old("status") == "active" )
                                            <option value="active" selected>{{ trans("home.active") }}</option>
                                            <option value="blocked">{{ trans("home.blocked") }}</option>
                                        @else
                                            <option value="blocked"  selected>{{ trans("home.blocked") }}</option>
                                            <option value="active">{{ trans("home.active") }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!-- ./col-4 -->
                        </div>
                        <!-- ./d-flex -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="permissions">{{ trans("roles.permission_title") }}</label>
                                <input class="form-control" name="permissions" value="{{ old('permissions') ? old( "permissions") : get_permissions($admin->permissions) }}"
                                       placeholder="{{ trans("roles.permission_title") }}" id="permissions" data-role="tagsinput">
                            </div>
                        </div>
                        <!-- ./col-12 -->


                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-3">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{ trans("users.picture") }} </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <img src="{{ image($admin->picture,true) }}" class="preview-img img" alt="" id="logo" {{ settings('picture') ? 'style=display:block' : null }} />
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <!-- /.row -->

    @push("js")
        <script src="{{ admin_assets('/js/jquery.amsify.suggestags.js') }}"></script>
        <script>
            $('#permissions').amsifySuggestags({
                suggestions: ("{{ get_permissions(\Spatie\Permission\Models\Permission::all()) }}").split(",")
            });
            $('#roles').amsifySuggestags({
                suggestions: ("{{ get_roles(\Spatie\Permission\Models\Role::all()) }}").split(",")
            })
        </script>
    @endpush

@endsection
