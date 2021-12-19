@extends("admin.layouts.index")

@section("content")

    @if(request()->has("keyword"))

        @push("css")
            {!! datatable_files("css") !!}
        @endpush
        <div class="row">
            <div class="col-12">
                @role("super-admin|admin|writer")
                    @if(user_can("view offers"))
                        <!-- TABLE: OFFERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans("offers.title") }}</h3>
                                <a class="btn btn-primary float-right" href="{{ route("offers.create") }}"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="offers" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("offers.company_logo") }}</th>
                                        <th>{{ trans("offers.company_name") }}</th>
                                        <th>{{ trans("offers.vip_rewards") }}</th>
                                        <th>{{ trans("offers.rewards") }}</th>
                                        <th>{{ trans("categories.title") }}</th>
                                        <th>{{ trans("home.actions") }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <span class="d-none">{{ $i = 1 }}</span>
                                    @forelse($offers as $offer)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <th><img src="{{ image($offer->company_logo,true) }}" alt="" class="table-img"></th>
                                            <th>{{ $offer->company_name  }}</th>
                                            <th>{{ $offer->vip_reward }}</th>
                                            <th>{{ $offer->reward }}</th>
                                            <th>{{  ($category = \App\Models\Category::find($offer->category_id)) ? $category->name . " - $category->name_ar" : "-"  }}</th>
                                            <th>
                                                <a href="{{ url("offer/". str_replace(" ", "-",$offer->name) ) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                                @if(user_can("edit offer"))
                                                    <a href="{{ admin_url("offers/$offer->id/edit") }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if(user_can("delete offer"))
                                                    <a class="btn btn-danger btn-delete"
                                                       data-url="{{ route("cash-back.destroy",$offer->id) }}"
                                                       data-name="{{ $offer->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                                @endif
                                            </th>
                                        </tr>
                                    @empty
                                    @endforelse

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("offers.company_logo") }}</th>
                                        <th>{{ trans("offers.company_name") }}</th>
                                        <th>{{ trans("offers.vip_rewards") }}</th>
                                        <th>{{ trans("offers.rewards") }}</th>
                                        <th>{{ trans("categories.title") }}</th>
                                        <th>{{ trans("home.actions") }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    @endif
                    @if(user_can("view categories"))
                        <!-- TABLE: CATEGORIES -->
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary" href="{{ admin_url("categories/create") }}"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="categories" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("categories.name") }}</th>
                                        <th>{{ trans("categories.name_ar") }}</th>
                                        <th>{{ trans("categories.sub") }}</th>
                                        <th>{{ trans("categories.related") }}</th>
                                        <th>{{ trans("home.actions") }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <span class="d-none">{{ $i = 1 }}</span>
                                    @forelse($categories as $category)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <th>{{ $category->name }}</th>
                                            <th>{{ $category->name_ar }}</th>
                                            <th>{{ !empty($category->subchild) ? \App\Models\Category::find($category->subchild)->name : "-" }}</th>
                                            <th><a href="{{ admin_url("offers/$category->id/category") }}" class="btn btn-success">{{ trans("categories.related") }}</a></th>
                                            <th>
                                                <a href="{{ url("category/". str_replace(" ", "-",$category->name) ) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                                @if(user_can("edit category"))
                                                    <a href="{{ admin_url("categories/$category->id/edit") }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if(user_can("delete category"))
                                                    <a class="btn btn-danger btn-delete"
                                                       data-url="{{ route("categories.destroy",$category->id) }}"
                                                       data-name="{{ $category->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                                @endif
                                            </th>
                                        </tr>
                                    @empty
                                    @endforelse

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("categories.name") }}</th>
                                        <th>{{ trans("categories.name_ar") }}</th>
                                        <th>{{ trans("categories.sub") }}</th>
                                        <th>{{ trans("categories.related") }}</th>
                                        <th>{{ trans("home.actions") }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    @endif
                    <!-- TABLE: CASH_BACK -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="title-header">{{ trans("offers.cash_back_title") }}</h3>
                            @if(user_can("create cash_back"))
                                <a class="btn btn-success btn-model-launch" data-toggle="modal" data-target="#cash_back_model"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="cash_back" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans("offers.rewards") }}</th>
                                    <th>{{ trans("offers.vip_rewards") }}</th>
                                    <th>{{ trans("offers.cash_back_title") }}</th>
                                    <th>{{ trans("home.actions") }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <span class="d-none">{{ $i = 1 }}</span>
                                @forelse($cash_backs as $cash_back)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <th>{{ $cash_back->reward }}%</th>
                                        <th class="warning-color">{{ $cash_back->vip_reward }}%</th>
                                        <th>{{ $cash_back->title  }}</th>
                                        <th>
                                            <a href="{{ admin_url("cash-back/$cash_back->id/edit") }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-delete"
                                               data-url="{{ route("cash-back.destroy",$cash_back->id) }}"
                                               data-name="{{ $cash_back->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                        </th>
                                    </tr>
                                @empty
                                @endforelse

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans("offers.rewards") }}</th>
                                    <th>{{ trans("offers.vip_rewards") }}</th>
                                    <th>{{ trans("offers.cash_back_title") }}</th>
                                    <th>{{ trans("home.actions") }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                @endrole

                @role("super-admin|admin")
                    @if(user_can("view clients"))
                        <!-- TABLE: CLIENTS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans("users.clients_title") }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="clients" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("users.picture") }}</th>
                                        <th>{{ trans("users.name") }}</th>
                                        <th>{{ trans("users.phone") }}</th>
                                        <th>{{ trans("users.balances") }}</th>
                                        <th>{{ trans("users.account_type") }}</th>
                                        <th>{{ trans("users.status") }}</th>
                                        <th>{{ trans("home.actions") }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <span class="d-none">{{ $i = 1 }}</span>
                                    @forelse($clients as $client)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <th style="width: 60px;"><img src="{{  image($client->picture)  }}" alt="" class="table-img"></th>
                                            <th>{{ $client->name }}</th>
                                            <th>{{ $client->phone }}</th>
                                            <th>{{ ($client->balances !== null) ? $client->balances->last()->money : "-"  }}</th>
                                            <th>{!! $client->account_type === "vip" ? "<span class='warning-color'>$client->account_type</span>" : $client->account_type !!}</th>
                                            <th>{!! $client->status == "blocked" ? "<span class='danger-color'>$client->status</span>" : "<span class='success-color'>$client->status</span>"  !!}</th>
                                            <th>
                                                @if(user_can('view client'))
                                                    <a href="{{ admin_url("clients/". str_replace(" ", "-",$client->username) ) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                                @elseif(user_can("edit client"))
                                                    <a href="{{ admin_url("clients/$client->username/edit") }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                @elseif(user_can("delete client"))
                                                    <a class="btn btn-danger btn-delete"
                                                       data-url="{{ route("clients.destroy",$client->id) }}"
                                                       data-name="{{ $client->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                                @endif
                                            </th>
                                        </tr>
                                    @empty
                                    @endforelse

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("users.picture") }}</th>
                                        <th>{{ trans("users.name") }}</th>
                                        <th>{{ trans("users.phone") }}</th>
                                        <th>{{ trans("users.balances") }}</th>
                                        <th>{{ trans("users.account_type") }}</th>
                                        <th>{{ trans("users.status") }}</th>
                                        <th>{{ trans("home.actions") }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    @endif
                @endrole

                @role("super-admin")
                    @if(user_can("view users"))
                        <!-- TABLE: USERS -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans("users.title") }}</h3>
                                @if(user_can("create user"))
                                    <a href="{{ route("users.create") }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="users" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("users.picture") }}</th>
                                        <th>{{ trans("users.name") }}</th>
                                        <th>{{ trans("users.phone") }}</th>
                                        <th>{{ trans("users.balances") }}</th>
                                        <th>{{ trans("users.permission") }}</th>
                                        <th>{{ trans("users.account_type") }}</th>
                                        <th>{{ trans("users.status") }}</th>
                                        <th>{{ trans("home.actions") }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <span class="d-none">{{ $i = 1 }}</span>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <th style="width: 60px;"><img src="{{  image($user->picture)  }}" alt="" class="table-img"></th>
                                            <th>{{ $user->name }}</th>
                                            <th>{{ $user->phone }}</th>
                                            <th>{{  "-"  }}</th> <!-- ($user->balances->last() !== null) ? $user->balances->last()->money : -->
                                            <th>{{ str_replace(",",",,,",ucfirst(get_role_name($user)))  }}</th>
                                            <th>{!! $user->account_type === "vip" ? "<span class='warning-color'>$user->account_type</span>" : $user->account_type !!}</th>
                                            <th>{!! $user->status == "blocked" ? "<span class='danger-color'>$user->status</span>" : "<span class='success-color'>$user->status</span>"  !!}</th>
                                            <th>
                                                @if(user_can(['view user', 'edit user']))
                                                    <a href="{{ admin_url("users/$user->id/edit") }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                @endif
                                                @if(user_can("delete user"))
                                                        <a class="btn btn-danger btn-delete "
                                                           data-url="{{ route("users.destroy",$user->id) }}"
                                                           data-name="{{ $user->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                                @endif
                                            </th>
                                        </tr>
                                    @empty
                                    @endforelse

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans("users.picture") }}</th>
                                        <th>{{ trans("users.name") }}</th>
                                        <th>{{ trans("users.phone") }}</th>
                                        <th>{{ trans("users.balances") }}</th>
                                        <th>{{ trans("users.permission") }}</th>
                                        <th>{{ trans("users.account_type") }}</th>
                                        <th>{{ trans("users.status") }}</th>
                                        <th>{{ trans("home.actions") }}</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    @endif
                    <!-- TABLE: ROLES -->
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="roles" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans("categories.name") }}</th>
                                    <th>{{ trans("categories.name_ar") }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <span class="d-none">{{ $i = 1 }}</span>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <th>{{ $role->name }}</th>
                                        <th>{{ $role->name_ar }}</th>

                                    </tr>
                                @empty
                                @endforelse

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans("categories.name") }}</th>
                                    <th>{{ trans("categories.name_ar") }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- TABLE: PERMISSIONS -->
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="permissions" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans("categories.name") }}</th>
                                    <th>{{ trans("categories.name_ar") }}</th>
                                    <th>{{ trans("roles.title") }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <span class="d-none">{{ $i = 1 }}</span>
                                @forelse($permissions as $permission)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <th>{{ $permission->name }}</th>
                                        <th>{{ $permission->name_ar }}</th>
                                        <th>{{ get_roles($permission->roles) }}</th>

                                    </tr>
                                @empty
                                @endforelse

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans("categories.name") }}</th>
                                    <th>{{ trans("categories.name_ar") }}</th>
                                    <th>{{ trans("roles.title") }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                @endrole
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        @push("js")
            {!! datatable_files("js",['offers','categories','cash_back','clients','users','roles','permissions']) !!}
        @endpush
    @endif
@endsection

