@extends("admin.layouts.index")

@section("content")

    @push("css")
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ admin_assets("css/jqvmap.min.css") }}">
    @endpush
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="@role('writer') col-lg-6 @endrole col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ count(\App\Models\Offer::all()) }}</h3>

                    <p>{{ trans("home.total_offers") }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-gifts"></i>
                </div>
                <a href="{{ admin_url("offers") }}" class="small-box-footer">{{ trans("home.more_info") }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="@role('writer') col-lg-6 @endrole col-lg-3  col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ count(\App\Models\Category::all()) }}</h3>

                    <p>{{ trans("categories.title") }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="{{ admin_url("categories") }}" class="small-box-footer">{{ trans("home.more_info") }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        @role('super-admin|admin')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ count(\App\Models\Client::all()) }}</h3>

                        <p>{{ trans("home.total_clients") }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ admin_url("clients") }}" class="small-box-footer">{{ trans("home.more_info") }} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        @endrole
        @role('super-admin')
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ count(\App\Models\Visitor::all()) }}</h3>

                        <p>{{ trans("home.visitors") }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="#" class="small-box-footer">{{ trans("home.more_info") }} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        @endrole
    </div>
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
            @role('super-admin|admin|writer')
                <!-- TABLE: OFFERS -->
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">{{ trans("offers.title") }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool btn-remove" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                            <tr>
                                <th>{{ trans("offers.company_name") }}</th>
                                <th>{{ trans("home.vip") . "/".trans("offers.rewards") }}</th>
                                <th>{{ trans("categories.title") }}</th>
                                <th>{{ trans("home.actions") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                                <tr>
                                    <td>
                                        <img src="{{ image($offer->company_logo,true) }}" alt="{{$offer->company_name}}" class="img-circle img-size-32 mr-2">
                                        {{$offer->company_name}}
                                    </td>
                                    <td>{{ "$offer->vip_reward/$offer->reward %" }}</td>
                                    <td>{{ (($category = $offer->category) !== null) ?$category->name . " - " . $category->name_ar:"-" }}</td>
                                    <td>
                                        @if(user_can("edit offer"))
                                            <a href="{{ admin_url("offers/$offer->id/edit") }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(user_can("delete offer"))
                                            <a class="btn btn-danger btn-delete"
                                               data-url="{{ route("cash-back.destroy",$offer->id) }}"
                                               data-name="{{ $offer->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            @endrole

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">

            @role('super-admin')
                <!-- Map card -->
                <div class="card bg-gradient-primary">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            {{ trans("home.visitors") }}
                        </h3>
                        <!-- card tools -->
                        <div class="card-tools">
    {{--                        <button type="button"--}}
    {{--                                class="btn btn-primary btn-sm daterange"--}}
    {{--                                data-toggle="tooltip"--}}
    {{--                                title="Date range">--}}
    {{--                            <i class="far fa-calendar-alt"></i>--}}
    {{--                        </button>--}}
                            <button type="button"
                                    class="btn btn-primary btn-sm"
                                    data-card-widget="collapse"
                                    data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <div id="world-map" data-url="{{ admin_url("visitors") }}" data-token="{{ csrf_token() }}" style="height: 250px; width: 100%;"></div>
                    </div>
                    <!-- /.card-body-->
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white visitors-count">Visitors</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white online-count">Online</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Sales</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card -->
                <!-- TABLE: VISITORS -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">{{ trans("home.most_viewed_page") }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                <tr>
                                    <th>{{ trans("home.times") }}</th>
                                    <th>{{ trans("home.country") }}</th>
                                    <th>{{ trans("home.page") }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(super_unique(\App\Models\Visitor::paginate(settings("paginate")),"page") as $visitor)
                                    <tr>
                                        <td>{{ count(\App\Models\Visitor::where("page","=",$visitor->page)->get()) }}</td>
                                        <td>{{ $visitor->country }}</td>
                                        <td>{{ $visitor->page }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            @endrole

        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    @push("js")
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ admin_assets("/js/jquery-ui.min.js") }}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Sparkline -->
        <script src="{{ admin_assets("js/sparkline.js") }}"></script>
        <!-- JQVMap -->
        <script src="{{ admin_assets("js/jquery.vmap.min.js") }}"></script>
        <script src="{{ admin_assets("js/jquery.vmap.world.js") }}"></script>
        <script src="{{ admin_assets("/js/dashboard.js") }}"></script>
    @endpush

@endsection
