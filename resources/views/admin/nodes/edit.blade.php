@extends('layout.admin')

@section('title')
    Update Node
@endsection

@section('admin-content')
    <p><small>Dashboard > Nodes > Update</small></p>
    <h2>Update Node</h2>
    <hr>

    <form method="POST" action="{{ route('nodes.update', $node->id)  }}" id="create-form">
        {{method_field('PUT')}}
        {{csrf_field()}}

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                @if ($errors->has('name') or session('error'))
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="Name" class="form-control" id="name" name="name" value="{{ session('error') ? session('name') : old('name') }}" required autofocus>
                        <label for="name" class="fa fa-bookmark" rel="tooltip" title="name"></label>
                    </div>
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @else
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="Name" class="form-control" id="name" name="name" value="{{ $node->name }}" required autofocus>
                        <label for="name" class="fa fa-bookmark" rel="tooltip" title="name"></label>
                    </div>
                @endif
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                <div class="icon-addon addon-lg">
                    <select class="form-control" title="Status" name="status" required>
                        <option value="Real Time">Real Time</option>
                        <option value="Non Real Time">Non Real Time</option>
                        <option value="Off">Off</option>
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
                    <input type="text" placeholder="Location" class="form-control" id="location" name="location" value="{{ session('error') ? session('location') : old('location') }}" required>
                    <label for="location" class="fa fa-map-marker" rel="tooltip" title="location"></label>
                </div>
                <span class="help-block">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @else
                <div class="icon-addon addon-lg">
                    <input type="text" placeholder="Location" class="form-control" id="location" name="location" value="{{ $node->location }}" required>
                    <label for="location" class="fa fa-map-marker" rel="tooltip" title="location"></label>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                @if ($errors->has('latitude') or session('error'))
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="Latitude" class="form-control" id="latitude" name="latitude" value="{{ session('error') ? session('latitude') : old('latitude') }}" required>
                        <label for="latitude" class="fa fa-globe" rel="tooltip" title="latitude"></label>
                    </div>
                    <span class="help-block">
                        <strong>{{ $errors->first('latitude') }}</strong>
                    </span>
                @else
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="Latitude" class="form-control" id="latitude" name="latitude" value="{{ $node->coordinates[0] }}" required>
                        <label for="latitude" class="fa fa-globe" rel="tooltip" title="latitude"></label>
                    </div>
                @endif
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                @if ($errors->has('longitude') or session('error'))
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="Longitude" class="form-control" id="longitude" name="longitude" value="{{ session('error') ? session('longitude') : old('longitude') }}" required>
                        <label for="longitude" class="fa fa-globe" rel="tooltip" title="longitude"></label>
                    </div>
                    <span class="help-block">
                        <strong> {{ $errors->first('longitude') }}</strong>
                    </span>
                @else
                    <div class="icon-addon addon-lg">
                        <input type="text" placeholder="Longitude" class="form-control" id="longitude" name="longitude" value="{{ $node->coordinates[1] }}" required>
                        <label for="longitude" class="fa fa-globe" rel="tooltip" title="longitude"></label>
                    </div>
                @endif
            </div>
        </div>

        <div id="createMap"></div>

        <p class="pull-right"><small>
            <i class="fa fa-info-circle text-primary"></i> &nbsp; Add a marker to the map and get its latitude and longitude
        </small></p>

        <br><br>
        <div class="row">
            <input type="submit" class="btn btn-primary btn-lg pull-right" value="Update">
        </div>
    </form>

@endsection

@section('modal')
    <div id="schemaModal" class="modal fade" role="dialog" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title tex"><strong>Set Node Data Schema</strong></h3>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <form id="node-type-form">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-4" for="type-name">Node Type Name</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="type-name" name="type-name" type="text" placeholder="e.g. Water Quality" required>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="form-group" id="sending-schema-div">
                                <label class="control-label col-md-4" for="sending-schema">Node Data Sending Schema
                                    <br>
                                    <small>(Data split by ;)</small>
                                </label>
                                <div class="col-md-8">
                                    <textarea class="form-control" rows="3" id="sending-schema" placeholder="e.g. 25.3;25.3;25.3;85;22.6;1.3;ESE;0.08;1.3;ESE;25.3;27.6;27.4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <br>
                            <button type="button" class="btn btn-primary pull-right" id="continue-btn" disabled>Continue</button>
                        </div>

                        <div id="elements-description-div" style="display: none">
                            <h4><strong>Parameters Type Selectors</strong></h4>
                            <div class="row" id="elements"></div>
                            <br><br>
                            <div class="row">
                                <a class="btn btn-danger" id="try-other-schema">Try Other Data Sending Schema </a>
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
