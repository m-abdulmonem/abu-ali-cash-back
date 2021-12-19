@extends("admin.layouts.index")
@section("content")

    <div class="row">
        <div class="col-12">

            <form action="{{ route("categories.store") }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans("home.create") }}</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="d-flex">
                            <div class="col-4">
                                <div class="form-group-group mb-3">
                                    <label for="name">{{ trans("categories.name") }}</label>
                                    <input type="text" class="form-control" id="name" placeholder="{{ trans("categories.name") }}" name="name">
                                </div>
                                <input type="hidden" class="input-link" name="link">
                                <div class="link " style="display: none">Link : <strong ><a target="_blank" class=""></a></strong></div>
                            </div>
                            <!-- ./col-4 -->
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="name_ar">{{ trans("categories.name_ar") }}</label>
                                    <input type="text" class="form-control" id="name_ar" placeholder="{{ trans("categories.name_ar") }}" name="name_ar">
                                </div>
                            </div>
                            <!-- ./col-4 -->
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <label for="subchild">{{ trans("categories.select") }}</label>
                                    <select name="subchild" id="subchild" class="form-control">
                                        <option value="{{ null }}">{{ trans("categories.select") }}</option>
                                        @if(old("subchild"))
                                            <option value="{{ old("subchild") }}">{{ \App\Models\Category::fin(old("subchild"))->name }}</option>
                                        @endif
                                        @forelse($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name  }}</option>
                                        @empty
                                            <option value="">{{ trans("categories.empty") }}</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <!-- ./col-4 -->
                        </div>
                        <!-- ./d-flex -->
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="details">{{ trans("categories.details") }}</label>
                                <textarea class="form-control" id="details" placeholder="{{ trans("categories.details") }}" name="details" style="min-height: 125px"></textarea>
                            </div>
                        </div>
                        <!-- ./col-12 -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </form>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

     @push("js")
         <script>

             $(function () {
                 $("#name").keyup(function () {

                     $(".link a")
                         .text("{{ url("category/") }}/"  + $(this).val().replace(" ","-"))
                         .attr("href","{{ url("category/") }}/"  + $(this).val().replace(" ","-"))
                         .parent().parent().show();

                     $(".input-link").val($(this).val().replace(" ","-"));
                 })
             })

         </script>
     @endpush

@endsection
