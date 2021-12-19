@extends("admin.layouts.index")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="ma-admin-datatable" class="table table-bordered table-striped">
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
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <th style="width: 60px;"><img src="{{  image($user->picture)  }}" alt="" class="table-img"></th>
                                <th>{{ $user->name }}</th>
                                <th>{{ $user->phone }}</th>
                                <th>{{ ($user->balances !== null) ? $user->balances->last()->money : "-"  }}</th>
                                <th>{!! $user->account_type === "vip" ? "<span class='warning-color'>$user->account_type</span>" : $user->account_type !!}</th>
                                <th>{!! $user->status == "blocked" ? "<span class='danger-color'>$user->status</span>" : "<span class='success-color'>$user->status</span>"  !!}</th>
                                <th>
                                    @if(user_can('view client'))
                                        <a href="{{ admin_url("clients/". str_replace(" ", "-",$user->username) ) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    @elseif(user_can("edit client"))
                                        <a href="{{ admin_url("clients/$user->username/edit") }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                    @elseif(user_can("delete client"))
                                        <a class="btn btn-danger btn-delete"
                                           data-url="{{ route("clients.destroy",$user->id) }}"
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
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    @push("js")
        {!! datatable_files() !!}
    @endpush
@endsection
