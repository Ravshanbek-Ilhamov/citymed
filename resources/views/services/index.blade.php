@extends('layouts.main')

@section('title' ,'Services' )

@section('content')
            
<div class="page-header">
    <h3 class="fw-bold mb-3">Services</h3>
    <ul class="breadcrumbs mb-3">
    <li class="nav-home">
        <a href="/statistics">
        <i class="icon-home"></i>
        </a>
    </li>
    <li class="separator">
        <i class="icon-arrow-right"></i>
    </li>
    <li class="nav-item">
        <a href="{{route('service.index')}}">Directions</a>
    </li>
    <li class="separator">
        <i class="icon-arrow-right"></i>
    </li>
    <li class="nav-item">
        <a href="{{route('service.index')}}">Services</a>
    </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <div class="card-title">All Services</div>
        </div>
        <div class="card-body">
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Direction</th>
                <th scope="col">Name</th>
                <th scope="col">Is_active</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{$service->id}}</td>
                        <td>{{$service->direction_id}}</td>
                        <td>{{$service->name}}</td>
                        <td>{{$service->is_active}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    </div>

</div>

<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<!-- Kaiadmin JS -->
<script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
<script>
$("#displayNotif").on("click", function () {
    var placementFrom = $("#notify_placement_from option:selected").val();
    var placementAlign = $("#notify_placement_align option:selected").val();
    var state = $("#notify_state option:selected").val();
    var style = $("#notify_style option:selected").val();
    var content = {};

    content.message =
    'Turning standard Bootstrap alerts into "notify" like notifications';
    content.title = "Bootstrap notify";
    if (style == "withicon") {
    content.icon = "fa fa-bell";
    } else {
    content.icon = "none";
    }
    content.url = "index.html";
    content.target = "_blank";

    $.notify(content, {
    type: state,
    placement: {
        from: placementFrom,
        align: placementAlign,
    },
    time: 1000,
    });
});
</script>

@endsection