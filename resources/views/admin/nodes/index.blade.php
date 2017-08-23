@extends('layout.admin')

@section('title')
    Nodes
@endsection

@section('admin-content')
    <a class="btn btn-primary pull-right" href="{{ url('admin/nodes/create') }}"> <i class="fa fa-plus"></i> @lang('Add new node') </a>
    <br>

    <p class="title">
        <h2 style="margin-bottom: 0;">@lang('Nodes')</h2>
        <small class="text-primary">@lang('Dashboard') > @lang('Nodes')</small>
    </p>

    @if (session('success-update'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong> {{ session('success-update') }}</strong>
        </div>
    @endif

    <table class="table" id="table" data-show-toggle="true" data-paging="true" data-sorting="true" data-filtering="true"> <!--data-expand-first="true"-->
        <thead>
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('Location')</th>
                <th data-breakpoints="xs">@lang('Coordinates')</th>
                <th data-breakpoints="xs sm">@lang('Status')</th>
                <th data-breakpoints="xs sm"> @lang('Actions')</th>
                <th data-breakpoints="all">@lang('Node Type')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nodes as $node)
                <tr>
                    <td>{{ $node->name }}</td>
                    <td>{{ $node->location }}</td>
                    <td>{{ $node->coordinates[0] }}, {{ $node->coordinates[1] }}</td>
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
                    <td><strong class="text-primary">@lang('Name') => </strong> {{ $node->node_type->name }}.
                        <br>
                        <strong class="text-primary">@lang('Data Delimiter') =></strong> {{ $node->separator }}.
                        <br>
                        <strong class="text-primary">@lang('Sending Schema') =></strong>
                        @foreach($node->node_type->sensors as $sensor)
                            <small>{{ $sensor["variable"] }}</small>
                            @if(!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        jQuery(function($){
            $('.table').footable();
        });
    </script>
@endsection
