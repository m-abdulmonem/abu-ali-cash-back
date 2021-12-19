@extends("admin.layouts.index")
@section("content")

    @push("css")
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ admin_assets("/css/select2.min.css") }}">
    @endpush
    <form action="{{ route("offers.store") }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-9">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans("home.create") }}</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex">
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="company_name">{{ trans("offers.company_name") }}</label>
                                    <input type="text" class="form-control" id="company_name" placeholder="{{ trans("offers.company_name") }}" name="company_name" value="{{ old("company_name") }}">
                                </div>
                            </div>
                            <!-- ./col-6 -->
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="coupon_code">{{ trans("offers.coupon_code") }}</label>
                                    <input type="text" class="form-control" id="coupon_code" placeholder="{{ trans("offers.coupon_code") }}" name="coupon_code" value="{{ old("coupon_code") }}">
                                </div>
                            </div>
                            <!-- ./col-6 -->
                        </div>
                        <!-- ./d-flex -->
                        <div class="d-flex">
                            <div class="col-4">
                                <div class="form-group ">
                                    <label for="vip_rewards">{{ trans("offers.vip_rewards") }}</label>
                                    <input type="text" class="form-control" id="vip_rewards" placeholder="{{ trans("offers.vip_rewards") }}" name="vip_reward" value="{{ old("vip_reward") }}">
                                </div>
                            </div>
                            <!-- ./col-4 -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="rewards">{{ trans("offers.rewards") }}</label>
                                    <input type="text" class="form-control" id="rewards" placeholder="{{ trans("offers.rewards") }}" name="reward" value="{{ old("reward") }}">
                                </div>
                            </div>
                            <!-- ./col-4 -->
                            <div class="col-4">
                                <div class="form-group ">
                                    <label for="category_id">{{ trans("offers.select_category") }}</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="{{ null }}">{{ trans("offers.select_category") }}</option>
                                        @if(old("category_id"))
                                            {{ $category = \App\Models\Category::find(old("category_id")) }}
                                            <option value="{{ old("category_id") }}">{{ $category->name }} - {{ $category->name_ar }}</option>
                                        @endif
                                        @forelse($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name  }} - {{ $category->name_ar }}</option>
                                        @empty
                                            <option value="">{{ trans("categories.empty") }}</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <!-- ./col-4 -->
                        </div>
                        <!-- ./col-12 -->

                        <div class="col-12">
                            <div class="form-group ">
                                <label for="exceptions">{{ trans("offers.exceptions") }}</label>
                                <textarea class="form-control" id="exceptions" placeholder="{{ trans("offers.exceptions") }}" name="exceptions" style="min-height: 125px">{{ old("exceptions") }}</textarea>
                            </div>
                        </div>
                        <!-- ./col-12 -->

                        <div class="col-12">
                            <div class="form-group ">
                                <label for="about_store">{{ trans("offers.about_store") }}</label>
                                <textarea class="form-control" id="about_store" placeholder="{{ trans("offers.about_store") }}" name="about_store" style="min-height: 125px">{{ old("about_store") }}</textarea>
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
                        <h3 class="title-header">{{ trans("offers.company_logo") }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <img src="{{ admin_assets("img/MAAdminLogo.png") }}" class="preview-img img" alt="" id="logo" {{ settings('logo') ? 'style=display:block' : null }} />
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
        </div>
    </form>
    <!-- /.row -->

    @push("js")
        <!-- Select2 -->
        <script src="{{ admin_assets("/js/select2.full.min.js") }}"></script>
        <script>
            $(function () {
                //Initialize Select2 Elements
                $('#category_id').select2();
            });
        </script>
    @endpush

@endsection
