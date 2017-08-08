@extends('layout.admin')

@section('title')
    Nodes
@endsection

@section('admin-content')

    <a class="btn btn-primary pull-right" href="{{ url('admin/nodes/create') }}"> @lang('Add new node') </a>

    <p class="title">
        <h2 style="margin-bottom: 0;">@lang('Nodes')</h2>
        <small class="text-primary">@lang('Dashboard') > @lang('Nodes')</small>
    </p>

    <div class="row">
        <div class="col-sm-6 pull-right">
            <div class="icon-addon addon-lg">
                <input type="text" class="form-control" id="filter" placeholder="@lang('Search for names') ...">
                <label for="filter" class="fa fa-filter"></label>
            </div>
        </div>
    </div>

    <br class="hidden-xs">

    @if (session('success-update'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong> {{ session('success-update') }}</strong>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover" id="table">
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('Location')</th>
                <th>@lang('Coordinates')</th>
                <th>@lang('Status')</th>
                <th></th>
            </tr>

            @foreach($nodes as $node)
                <tr>
                    <td>{{ $node->name }}</td>
                    <td>{{ $node->location }}</td>
                    <td><small>{{ $node->coordinates[0] }}, {{ $node->coordinates[1] }}</small></td>
                    <td>
                        @if($node->status == 'Real Time')
                            @lang('Real Time')
                        @elseif( $node->status == 'Non RT')
                            @lang('Non RT')
                        @else
                            @lang('Off')
                        @endif
                    </td>
                    <td><a class="btn-link fa fa-pencil" href="{{route('nodes.edit', $node->id)}}"></a></td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection

@section('scripts')
    <script>
        $(function(){
            $('#filter').keyup(function(e){
                // Declare variables
                var input, filter, table, tr, td, i;
                input = document.getElementById("filter");
                filter = input.value.toUpperCase();
                table = document.getElementById("table");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                var size = 0;
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            size += 1;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }

                // No results found message
                if(size == 0){
                    //if doesn't exist
                    if($("#no-found").length == 0) {
                        $("#table").append('<td id="no-found" colspan="5" class="text-center text-primary"><h4>@lang('No results found')</h4></td>');
                    }
                }else{
                    $("#no-found").remove();
                }
            });
        });
    </script>
@endsection
