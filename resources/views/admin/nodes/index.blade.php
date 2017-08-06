@extends('layout.admin')

@section('title')
    Create Node
@endsection

@section('admin-content')
    <p><small>Dashboard > Nodes </small></p>
    <h2>Nodes</h2>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Location</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Status</th>
                <th></th>
            </tr>

            @foreach($nodes as $node)
                <tr>
                    <td>{{ $node->id }}</td>
                    <td>{{ $node->name }}</td>
                    <td>{{ $node->location }}</td>
                    <td>{{ $node->coordinates[0] }}</td>
                    <td>{{ $node->coordinates[1] }}</td>
                    <td>{{ $node->status }}</td>
                    <td><a class="btn btn-sm glyphicon glyphicon-pencil" href="javascript:void(0)"></a></td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection
