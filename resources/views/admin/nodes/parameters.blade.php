@extends('layout.admin')

@section('title')
    Parameters
@endsection

@section('admin-content')
    <p class="title">
    <h2 style="margin-bottom: 0;">Available Parameters</h2>
    <small class="text-primary">@lang('Dashboard') > @lang('Nodes') > Parameters</small>
    </p>

    <ul class="list-group">
        @foreach($sensors as $sensor)
            <li class="list-group-item">
                <strong>{{ $sensor->variable }}</strong> ({{ $sensor->unit }}): {{ $sensor->description }}
            </li>
        @endforeach
    </ul>
@endsection