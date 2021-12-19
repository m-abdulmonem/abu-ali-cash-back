@extends("admin.layouts.index")
@section("content")

    @push("css")
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ admin_assets("/css/select2.min.css") }}">
    @endpush

    <form action="{{ route("cash-back.store") }}" method="POST">
        <div class="row">
            <div class="col-12">
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
                                    <label for="company_name">{{ trans("cashBack.title") }}</label>
                                    <input type="text" class="form-control" id="company_name" placeholder="{{ trans("cashBack.title") }}" name="title" value="{{ old("title") }}">
                                </div>
                            </div>
                            <!-- ./col-6 -->
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="offer_id">{{ trans("cashBack.select_offer") }}</label>
                                    <select name="offer_id" id="offer_id" class="form-control">
                                        <option value="{{ null }}">{{ trans("cashBack.select_offer") }}</option>
                                        @if(old("offer_id"))
                                            <option value="{{ old("offer_id") }}" selected>{{ \App\Models\Offer::find(old("offer_id")) }}</option>
                                        @endif
                                        @forelse($offers as $offer)
                                            <option value="{{ $offer->id }}">{{ $offer->company_name  }}</option>
                                        @empty
                                            <option value="">{{ trans("categories.Empty") }}</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <!-- ./col-6 -->
                        </div>
                        <!-- ./d-flex -->
                        <div class="d-flex">
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="vip_rewards">{{ trans("offers.vip_rewards") }}</label>
                                    <input type="text" class="form-control" id="vip_rewards" placeholder="{{ trans("offers.vip_rewards") }}" name="vip_reward" value="{{ old("vip_reward") }}">
                                </div>
                            </div>
                            <!-- ./col-6 -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="rewards">{{ trans("offers.rewards") }}</label>
                                    <input type="text" class="form-control" id="rewards" placeholder="{{ trans("offers.rewards") }}" name="reward" value="{{ old("reward") }}">
                                </div>
                            </div>
                            <!-- ./col-6 -->
                        </div>
                        <!-- ./col-12 -->

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
                $('#offer_id').select2()
            });
        </script>
    @endpush

@endsection
