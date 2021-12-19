@extends("admin.layouts.index")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
    @endpush
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{ $create }}"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="ma-admin-datatable" class="table table-bordered table-striped">
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
                                    <a href="{{ admin_url("offers/$offer->id/edit") }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-delete"
                                       data-url="{{ route("cash-back.destroy",$offer->id) }}"
                                       data-name="{{ $offer->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
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
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    @push("js")
        {!! datatable_files() !!}
    @endpush
@endsection
