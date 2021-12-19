@extends("admin.layouts.index")
@section("content")
    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> {{ trans("home.Oops! Page not found.") }}</h3>

            <p>
                {!! trans('home.  We could not find the page you were looking for.Meanwhile, you may <a href="">return to dashboard</a> or try using the search form.') !!}
                {{--                We could not find the page you were looking for.--}}
{{--                Meanwhile, you may <a href="">return to dashboard</a> or try using the search form.--}}
            </p>

            <form class="search-form"  action="{{ admin_url("search/all") }}">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="{{ trans("home.search") }}">

                    <div class="input-group-append">
                        <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- /.input-group -->
            </form>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
@endsection
