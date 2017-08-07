@extends('layout.app')

@section('title')
    AquApp
@endsection

@section('styles')
    <link href="/css/admin.css" rel="stylesheet">
@endsection

@section('content')
    <div class="col-sm-4 col-md-3 fixed">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{ url('/') }}"><span class="fa fa-home"></span> &nbsp; Home</a> </h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="fa fa-map-pin"></i> &nbsp; Nodes <span class="caret"></span>
                        </a>
                    </h4>
                </div>
                <!-- Note: By adding "in" after "collapse", it starts with that particular panel open by default; remove if you want them all collapsed by default -->
                <div id="collapseOne" class="panel-collapse collapse in">
                    <ul class="list-group">
                        <li class="{{ Request::path() == 'admin/nodes' ? 'active' : ''}}"><a href="{{ url('admin/nodes') }}">Browse list of nodes</a></li>
                        <li class="{{ Request::path() == 'admin/nodes/create' ? 'active' : ''}}"><a href="{{ url('admin/nodes/create') }}">Add a new node</a></li>
                    </ul>
                </div>
            </div>

            <!-- end hidden Menu items -->
        </div>
    </div>

    @yield('modal')

    <div class="col-sm-8 col-md-9 scroll">
        <div class="content">
            @yield('admin-content')
        </div>
    </div>
@endsection