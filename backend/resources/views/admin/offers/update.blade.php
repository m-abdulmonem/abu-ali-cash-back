@extends("admin.layouts.index")
@section("content")
    @push("css")
        {!! datatable_files("css") !!}
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ admin_assets("/css/select2.min.css") }}">
    @endpush
    <form action="{{ route("offers.update",$offer->id) }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-9">
                @csrf
                @method("PUT")
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans("home.save") }}</button>
                        <a class="btn btn-success" href="{{ admin_url("offers/create") }}"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                        <div class="btn btn-danger btn-delete float-right"
                             data-url="{{ route("offers.destroy",$offer->id) }}"
                             data-name="{{ $offer->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i> {{ trans("home.delete") }}</div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex">
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="company_name">{{ trans("offers.company_name") }}</label>
                                    <input type="text" class="form-control" id="company_name" placeholder="{{ trans("offers.company_name") }}" name="company_name" value="{{ old("company_name") ?old("company_name") : $offer->company_name }}">
                                </div>
                            </div>
                            <!-- ./col-6 -->
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="coupon_code">{{ trans("offers.coupon_code") }}</label>
                                    <input type="text" class="form-control" id="coupon_code" placeholder="{{ trans("offers.coupon_code") }}" name="coupon_code" value="{{ old("coupon_code") ?old("coupon_code") : $offer->coupon_code }}">
                                </div>
                            </div>
                            <!-- ./col-6 -->
                        </div>
                        <!-- ./d-flex -->

                        <div class="d-flex">
                            <div class="col-4">
                                <div class="form-group ">
                                    <label for="vip_rewards">{{ trans("offers.vip_rewards") }}</label>
                                    <input type="text" class="form-control" id="vip_rewards" placeholder="{{ trans("offers.vip_rewards") }}" name="vip_reward" value="{{ old("vip_reward") ?old("vip_reward") : $offer->vip_reward }} ">
                                </div>
                            </div>
                            <!-- ./col-4 -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="rewards">{{ trans("offers.rewards") }}</label>
                                    <input type="text" class="form-control" id="rewards" placeholder="{{ trans("offers.rewards") }}" name="reward" value="{{ old("reward") ?old("reward") : $offer->reward }}">
                                </div>
                            </div>
                            <!-- ./col-4 -->
                            <div class="col-4">
                                <div class="form-group ">
                                    <label for="category_id">{{ trans("offers.select_category") }}</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="{{ null }}">{{ trans("offers.select_category") }}</option>
                                        @if($offer->category_id !== null)
                                            {{ $category = \App\Models\Category::find($offer->category_id) }}
                                            <option selected value="{{ $offer->category_id }}">{{ $category !== null ? $category->name . " - $category->name_ar" : "-"  }}</option>
                                        @endif
                                        @if(old("category_id"))
                                            {{ $category = \App\Models\Category::find(old("category_id")) }}
                                            <option value="{{ old("category_id") }}" selected>{{ "$category->name - $category->name_ar" }}</option>
                                        @endif
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ "$category->name - $category->name_ar"  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- ./col-4 -->
                        </div>
                        <!-- ./col-12 -->

                        <div class="col-12">
                            <div class="form-group ">
                                <label for="exceptions">{{ trans("offers.exceptions") }}</label>
                                <textarea class="form-control" id="exceptions" placeholder="{{ trans("offers.exceptions") }}" name="exceptions" style="min-height: 125px">{{ old("exceptions") ?old("exceptions") : $offer->exceptions }}</textarea>
                            </div>
                        </div>
                        <!-- ./col-12 -->

                        <div class="col-12">
                            <div class="form-group ">
                                <label for="about_store">{{ trans("offers.about_store") }}</label>
                                <textarea class="form-control" id="about_store" placeholder="{{ trans("offers.about_store") }}" name="about_store" style="min-height: 125px">{{ old("about_store") ?old("about_store") : $offer->about_store }}</textarea>
                            </div>
                        </div>
                        <!-- ./col-12 -->

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{ trans("offers.company_logo") }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <img src="{{ image($offer->company_logo,true) }}" class="preview-img img" alt="" id="logo" {{ settings('logo') ? 'style=display:block' : null }} />
                                <div class="btn btn-default btn-file">{{ trans("settings.Logo") }}
                                    <i class="fas fa-paperclip"></i>
                                    <input type="file" value="{{ old('content') }}" class="upload" name="company_logo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="title-header">{{ trans("offers.cash_back_title") }}</h3>
                        <a class="btn btn-success btn-model-launch" data-toggle="modal" data-target="#cash_back_model"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                        <div class="btn btn-danger btn-delete float-right"
                             data-url="{{ route("offers.destroy",$offer->id) }}"
                             data-name="{{ $offer->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i> {{ trans("home.delete") }}</div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="ma-admin-datatable" class="table table-bordered table-striped">
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
            </div>
            <!-- /.col -->
        </div>
    </form>
    <!-- /.row -->

    <!-- Modal -->
    <div class="modal fade" id="cash_back_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" id="cash_back_form">
                    @csrf
                    <input type="hidden" value="{{ $offer->id }}" name="offer_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ trans("offers.cash_back_create_title") }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group ">
                            <label for="title">{{ trans("cashBack.title") }}</label>
                            <input type="text" class="form-control" id="title" placeholder="{{ trans("cashBack.title") }}" name="title" value="{{ old("title") }}">
                        </div>
                        <div class="form-group ">
                            <label for="vip_rewards">{{ trans("offers.vip_rewards") }}</label>
                            <input type="text" class="form-control" id="vip_rewards" placeholder="{{ trans("offers.vip_rewards") }}" name="vip_reward" value="{{ old("vip_reward") }}">
                        </div>
                        <div class="form-group">
                            <label for="rewards">{{ trans("offers.rewards") }}</label>
                            <input type="text" class="form-control" id="rewards" placeholder="{{ trans("offers.rewards") }}" name="reward" value="{{ old("reward") }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{ trans("home.close") }}</button>
                        <button type="submit" class="btn btn-outline-primary btn-submit" data-mode="close" data-action="add">{{ trans("home.add_close") }}</button>
                        <button type="submit" class="btn btn-outline-success btn-submit" data-mode="anther" data-action="add">{{ trans("home.add_anther") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push("js")

        {!! datatable_files() !!}
        <!-- Select2 -->
        <script src="{{ admin_assets("/js/select2.full.min.js") }}"></script>
        <script>
            $(function () {
                //Initialize Select2 Elements
                $('#category_id').select2()

                $("#cash_back_form").on("submit",function (event) {
                    event.preventDefault();

                    let mode;
                    $(".btn-submit").on("click",function () {
                        mode = $(this).data("mode")
                    });
                    if ($(".btn-submit").data("action") === "add"){

                        $.ajax({
                            url: "{{ route("cash-back.store") }}",
                            method: "POST",
                            data: new FormData(this),
                            contentType:false,
                            cache:false,
                            processData: false,
                            dataType: "json",
                            success: function (data) {
                                if (data.status === 200){
                                    if (mode=== "close")
                                        $("#cash_back_model").modal('hide');
                                    $("#cash_back_form").trigger("reset");
                                    swal(data.msg,{
                                        icon: "success",
                                        timer:1490
                                    });
                                    setTimeout(function () {
                                        location.reload()
                                    },1500)

                                }
                                swal(data.msg)

                            },
                            error: function (x,y) {
                              // console.log(x,y)
                            }
                        })

                        // swal("hi")
                    }
                })


            })
        </script>
    @endpush
@endsection
