@include("admin.layouts.header")

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {!! get_breadcrumb(2,3,$title) !!}
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">

        @if(session()->has("info"))
            <div class="alert alert-info">{{ session("info") }}</div>
        @endif
        @if(isset($errors))
            @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        @endif
        @yield("content")

    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@push("js")
    @if(session()->has("error"))
        <script>
            swal("{{ session("error") }}",{
                icon: "error",
            })
        </script>
    @elseif(session()->has("access_denied"))
        <script>
            swal("{{ session("access_denied") }}",{
                icon: "warning",
                timer: 3000
            })
        </script>
    @elseif(session()->has("success"))
        <script>
            swal("{{ session("success") }}",{
                icon: "success",
            })
        </script>
    @elseif(session()->has("password_updated"))
        <script>
            swal("{{ session("password_updated") }}",{
                icon: "success",
                timer: 1500
            })
        </script>
        {{ auth()->logout() }}
        {{ redirect(admin_url("login")) }}
    @endif
@endpush
@include("admin.layouts.footer")
