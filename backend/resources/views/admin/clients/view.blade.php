@extends("admin.layouts.index")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{ trans("users.main_info") }}</h1>
                    <div class="btn btn-danger btn-delete float-right"
                         data-url="{{ route("clients.destroy",$user->id) }}"
                         data-name="{{ $user->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i> {{ trans("home.delete") }}</div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="main-info d-flex">
                        <img class="img-rounded" src="{{ image($user->picture) }}" alt="">
                        <div class="info user-info">
                            <div class="d-flex align-items-center ">
                                <h5>{{ $user->name }}</h5> <small>{{ $user->country ? "-".$user->country : null }}</small>
                            </div>
                            <h6>{{ $user->phone }}</h6>
                            <h6>{{ trans("users.status") }}: <strong class="success-color">{!!  $user->status == "blocked" ? "<span class='danger-color'>$user->status</span>" : $user->status  !!}</strong> <i class="fa fa-pen edit"
                                                                                                                           data-toggle="modal" data-target="#editUser"></i></h6>
                            <h6>{{ trans("users.account_type") }}: <strong class="warning-color">{{ $user->account_type }}</strong> <i class="fa fa-pen edit"
                                                                                                                                       data-toggle="modal" data-target="#editUser"></i></h6>
                        </div>
                    </div>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans("users.balances") }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="ma-admin-datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans("users.money") }}</th>
                            <th>{{ trans("users.currency") }}</th>
                            <th>{{ trans("users.date") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <span class="d-none">{{ $i = 1 }}</span>
{{--                        @forelse($user->balances as $balance)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $i++ }}</td>--}}
{{--                                <th>{{ $balance->money }}</th>--}}
{{--                                <th>{{ $balance->currency }}</th>--}}
{{--                                <th>{{ $balance->created_at }}</th>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                        @endforelse--}}

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>{{ trans("users.money") }}</th>
                            <th>{{ trans("users.currency") }}</th>
                            <th>{{ trans("users.date") }}</th>
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
    <!-- Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route("clients.update",$user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans("users.edit_title") }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">{{ trans("users.status") }}</label>
                            <select name="status" id="status" class="form-control status">
                                @if($user->status == "active")
                                    <option value="active" selected>{{ trans("home.active") }}</option>
                                    <option value="blocked">{{ trans("home.blocked") }}</option>
                                @else
                                    <option value="active">{{ trans("home.active") }}</option>
                                    <option value="blocked" selected>{{ trans("home.blocked") }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">{{ trans("users.account_type") }}</label>
                            <select name="account_type" id="status" class="form-control account-type">
                                @if($user->account_type === "basic")
                                    <option value="basic" selected>{{ trans("home.basic") }}</option>
                                    <option value="vip">{{ trans("home.vip") }}</option>
                                @else
                                    <option value="vip" selected>{{ trans("home.vip") }}</option>
                                    <option value="basic">{{ trans("home.basic") }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans("home.close") }}</button>
                        <button type="submit" class="btn btn-primary save">{{ trans("home.save") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push("js")
        {!! datatable_files() !!}
    @endpush


@endsection
