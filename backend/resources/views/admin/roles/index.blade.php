@extends("admin.layouts.index")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

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
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    @push("js")
        {!! datatable_files("js",["permissions","roles"]) !!}
    @endpush
@endsection
