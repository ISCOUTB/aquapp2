@extends('layout.admin')

@section('title')
    Update Node
@endsection

@section('admin-content')
    <p class="title">
        <h2 style="margin-bottom: 0;">@lang('Update Node')</h2>
        <small class="text-primary">@lang('Dashboard') > @lang('Nodes') > @lang('Update')</small>
    </p>

    <hr>

    <form method="POST" action="{{ route('nodes.update', $node->id)  }}" id="create-form">
        {{method_field('PUT')}}
        {{csrf_field()}}

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                @if ($errors->has('name') or session('error'))
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="@lang('Name')" class="form-control" id="name" name="name" value="{{ session('error') ? session('name') : old('name') }}" required autofocus>
                        <label for="name" class="fa fa-bookmark" rel="tooltip" title="name"></label>
                    </div>
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @else
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="@lang('Name')" class="form-control" id="name" name="name" value="{{ $node->name }}" required autofocus>
                        <label for="name" class="fa fa-bookmark" rel="tooltip" title="name"></label>
                    </div>
                @endif
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                <div class="icon-addon addon-lg">
                    <select class="form-control" name="status" required>
                        <option value="Real Time">@lang('Real Time')</option>
                        <option value="Non Real Time">@lang('Non Real Time')</option>
                        <option value="Off">@lang('Off')</option>
                    </select>
                </div>
                @if ($errors->has('status'))
                    <span class="help-block">
                        <strong> {{ $errors->first('status') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
            @if ($errors->has('location') or session('error'))
                <div class="icon-addon addon-lg">
                    <input type="text" placeholder="@lang('Location')" class="form-control" id="location" name="location" value="{{ session('error') ? session('location') : old('location') }}" required>
                    <label for="location" class="fa fa-map-marker" rel="tooltip" title="location"></label>
                </div>
                <span class="help-block">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @else
                <div class="icon-addon addon-lg">
                    <input type="text" placeholder="@lang('Location')" class="form-control" id="location" name="location" value="{{ $node->location }}" required>
                    <label for="location" class="fa fa-map-marker" rel="tooltip" title="location"></label>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                @if ($errors->has('latitude') or session('error'))
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="@lang('Latitude')" class="form-control" id="latitude" name="latitude" value="{{ session('error') ? session('latitude') : old('latitude') }}" required>
                        <label for="latitude" class="fa fa-globe" rel="tooltip" title="latitude"></label>
                    </div>
                    <span class="help-block">
                        <strong>{{ $errors->first('latitude') }}</strong>
                    </span>
                @else
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="@lang('Latitude')" class="form-control" id="latitude" name="latitude" value="{{ $node->coordinates[0] }}" required>
                        <label for="latitude" class="fa fa-globe" rel="tooltip" title="latitude"></label>
                    </div>
                @endif
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                @if ($errors->has('longitude') or session('error'))
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="@lang('Longitude')" class="form-control" id="longitude" name="longitude" value="{{ session('error') ? session('longitude') : old('longitude') }}" required>
                        <label for="longitude" class="fa fa-globe" rel="tooltip" title="longitude"></label>
                    </div>
                    <span class="help-block">
                        <strong> {{ $errors->first('longitude') }}</strong>
                    </span>
                @else
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="@lang('Longitude')" class="form-control" id="longitude" name="longitude" value="{{ $node->coordinates[1] }}" required>
                        <label for="longitude" class="fa fa-globe" rel="tooltip" title="longitude"></label>
                    </div>
                @endif
            </div>
        </div>

        <div id="createMap"></div>

        <p class="pull-right"><small>
            <i class="fa fa-info-circle text-primary"></i> &nbsp; @lang('Add a marker to the map and get its latitude and longitude')
        </small></p>

        <br><br>
        <div class="row">
            <input type="submit" class="btn btn-primary btn-lg pull-right" value="@lang('Update')">
        </div>
    </form>

@endsection

@section('scripts')
    <script>
        $( function() {
            <!-- Leaflet Map -->
            var map = L.map('createMap').setView([10.4207375,-75.5475544], 15);

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                id: 'mapbox.streets'
            }).addTo(map);

            // Add marker to map
            var markers = [];

            var latitude = {{ $node->coordinates[0] }};
            var longitude = {{ $node->coordinates[1] }};

            var marker = new L.marker([latitude, longitude]).addTo(map);
            markers.push(marker);

            map.on('click', function(e) {
                // Remove leaflet map markers
                for(var i = 0; i < markers.length; i++){
                    map.removeLayer(markers[i]);
                }

                // Add new markers
                var latitude = e.latlng.lat;
                var longitude = e.latlng.lng;

                $("#latitude").val(latitude);
                $("#longitude").val(longitude);

                // Add marker to map at click location; add popup window
                var marker = new L.marker(e.latlng).addTo(map);
                markers.push(marker);
            });
        });
    </script>
@endsection
