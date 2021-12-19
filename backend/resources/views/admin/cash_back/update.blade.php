@extends("admin.layouts.index")
@section("content")

    @push("css")
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ admin_assets("/css/select2.min.css") }}">
    @endpush

    <form action="{{ route("cash-back.update",$cash_back->id) }}" method="POST">
        <div class="row">
            <div class="col-12">
                @csrf
                @method("PUT")
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-Save"></i> {{ trans("home.save") }}</button>
                        <a class="btn btn-success" href="{{ admin_url("cash-back/create") }}"><i class="fa fa-plus"></i> {{ trans("home.new") }}</a>
                        <div class="btn btn-danger btn-delete float-right"
                             data-url="{{ route("cash-back.destroy",$cash_back->id) }}"
                             data-name="{{ $cash_back->name }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i> {{ trans("home.delete") }}</div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex">
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="company_name">{{ trans("cashBack.title") }}</label>
                                    <input type="text" class="form-control" id="company_name" placeholder="{{ trans("cashBack.title") }}" name="title" value="{{ old("title") ? old("title") : $cash_back->title }}">
                                </div>
                            </div>
                            <!-- ./col-6 -->
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="offer_id">{{ trans("cashBack.select_offer") }}</label>
                                    <select name="offer_id" id="offer_id" class="form-control">
                                        <option value="{{ null }}">{{ trans("cashBack.select_offer") }}</option>
                                        @if($cash_back->offer_id)
                                            <option value="{{ $cash_back->offer_id }}" selected>{{ \App\Models\Offer::find($cash_back->offer_id)->company_name }}</option>
                                        @endif
                                        @if(old("offer_id"))
                                            <option value="{{ old("offer_id") }}" selected>{{ \App\Models\Offer::find(old("offer_id"))->company_name }}</option>
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
                                    <input type="text" class="form-control" id="vip_rewards" placeholder="{{ trans("offers.vip_rewards") }}" name="vip_reward" value="{{ old("vip_reward") ? old("vip_reward") : $cash_back->vip_reward }}">
                                </div>
                            </div>
                            <!-- ./col-6 -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="rewards">{{ trans("offers.rewards") }}</label>
                                    <input type="text" class="form-control" id="rewards" placeholder="{{ trans("offers.rewards") }}" name="reward" value="{{ old("reward") ? old("reward") : $cash_back->reward }}">
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
