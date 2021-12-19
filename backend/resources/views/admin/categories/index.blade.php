@extends("admin.layouts.index")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{ admin_url("categories/create") }}"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="ma-admin-datatable" class="table table-bordered table-striped">
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
                                    <a href="{{ admin_url("categories/$category->id/edit") }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-delete"
                                       data-url="{{ route("categories.destroy",$category->id) }}"
                                       data-name="{{ $category->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
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
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    @push("js")
        {!! datatable_files() !!}
    @endpush
@endsection
