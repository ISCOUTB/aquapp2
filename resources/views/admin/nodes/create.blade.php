@extends('layout.admin')

@section('title')
    Create Node
@endsection

@section('content')
    <p><small>Dashboard > Nodes > Create</small></p>
    <h2>Create Node</h2>
    <hr>

    <form method="POST" action="{{ route('nodes.store') }}" id="create-form">
        {{csrf_field()}}

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="icon-addon addon-lg">
                    <input type="text" placeholder="Name" class="form-control" id="name" name="name" value="{{ session('error') ? session('name') : old('name') }}" required autofocus>
                    <label for="name" class="glyphicon glyphicon-bookmark" rel="tooltip" title="name"></label>
                </div>
                @if ($errors->has('name'))
                    <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
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
            <div class="icon-addon addon-lg">
                <input type="text" placeholder="Location" class="form-control" id="location" name="location" value="{{ session('error') ? session('location') : old('location') }}" required>
                <label for="location" class="glyphicon glyphicon-map-marker" rel="tooltip" title="location"></label>
            </div>
            @if ($errors->has('location'))
                <span class="help-block">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @endif
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                <div class="icon-addon addon-lg">
                    <input type="text" placeholder="Latitude" class="form-control" id="latitude" name="latitude" value="{{ session('error') ? session('latitude') : old('latitude') }}" required>
                    <label for="latitude" class="glyphicon glyphicon-globe" rel="tooltip" title="latitude"></label>
                </div>
                @if ($errors->has('latitude'))
                    <span class="help-block">
                    <strong>{{ $errors->first('latitude') }}</strong>
                </span>
                @endif
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                <div class="icon-addon addon-lg">
                    <input type="text" placeholder="Longitude" class="form-control" id="longitude" name="longitude" value="{{ session('error') ? session('longitude') : old('longitude') }}" required>
                    <label for="longitude" class="glyphicon glyphicon-globe" rel="tooltip" title="longitude"></label>
                </div>
                @if ($errors->has('longitude'))
                    <span class="help-block">
                        <strong> {{ $errors->first('longitude') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div id="createMap"></div>

        <p class="pull-right"><small>
            <span class="glyphicon glyphicon-info-sign text-primary" aria-hidden="true"></span>
            Add a marker to the map and get its latitude and longitude
        </small></p>

        <br><br>

        <h3>Choose Node Type</h3>
        <hr>

        <div id="data-schema"></div>

        <div class="row" id="select-node-type">

            <div class="col-xs-12{{ session('error') ? ' has-error' : '' }}">
                @if (session('error'))
                    <small class="help-block">
                        <strong> {{ session('error') }}</strong>
                    </small>
                @endif
            </div>

            @foreach($nodeTypes as $nodeType)
                <div class="col-sm-6">
                    <div class="radio radio-primary">
                        <input type="radio" name="node-type" id="{{ $nodeType->id }}" value="{{ $nodeType->id }}" @if ($loop->first) checked @endif>

                        <label for="{{ $nodeType->id }}">
                            {{ $nodeType->name }}

                            <dl>
                                <dt><small class="text-primary">Parameters</small></dt>

                                @foreach($nodeType->sensors as $sensor)
                                    <dd><small>
                                        {{ $sensor["variable"]}}

                                        @if(array_key_exists('unit', $sensor))
                                            ({{ $sensor["unit"] }})
                                        @endif
                                        @if(array_key_exists('description', $sensor))
                                            : {{ $sensor["description"] }}
                                        @endif
                                    </small></dd>
                                @endforeach
                            </dl>
                        </label>
                    </div>
                </div>
            @endforeach
            <div class="col-sm-6">
                <div class="radio radio-primary">
                    <input type="radio" name="node-type" id="node-type" data-toggle="modal" data-target="#schemaModal" value="sending-schema">
                    <label for="node-type">
                        Choose Data Sending Schema
                    </label>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <input type="submit" class="btn btn-primary btn-lg pull-right" value="Save">
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

            var markers = [];
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

            <!-- Errors Handling: Leaflet Map -->
            @if (count($errors) > 0 or session('error'))
                var latitude = {{ old('latitude') ? old('latitude') : session('latitude') }};
                var longitude = {{ old('longitude') ? old('longitude') : session('longitude') }};

                map.setView(new L.LatLng(latitude, longitude), 15); // Center map
                var marker = L.marker([latitude, longitude]).addTo(map); // Add marker
            @endif

            <!-- Sending Data Schema -->
            // Enable Continue button according to sending-schema text area
            $('#continue-btn').attr('disabled',true);
            $('#sending-schema').keyup(function(){
                if($(this).val().length !=0)
                    $("#continue-btn").attr('disabled', false);
                else
                    $("#continue-btn").attr('disabled',true);
            });

            // Process data schema
            var schema;
            $("#continue-btn").click(function() {
                var schema_str = $("#sending-schema").val();
                schema = schema_str.split(";");

                var variables = ["Depth","Dissolved Oxygen","Percent Saturation","pH","Salinity","Specific Conductivity","Turbidity","Water Temperature",
                    "Chrolophyll a","Nitrate","Nitrite","Nitrite + Nitrate","Orthophosphate"];

                var type_options = "";

                for(var i=0; i<variables.length; i++){
                    type_options = type_options.concat('<option value="'+variables[i]+'">'+variables[i]+'</option>');
                }

                var content = [];
                for(var j=0; j<schema.length; j++){
                    if(schema[j] != ""){
                        var element = '<div class="col-md-6 col-xs-6" style="padding: 10px">' +
                                '<label class="control-label col-md-4" for="name"><span class="text-muted">'+ (j+1) + " - </span>" +schema[j] +'</label>' +
                                '<div class="col-md-8">' +
                                '<select class="form-control" id="'+ j +'" required>' + type_options +
                                '</select>'+
                                '</div>' +
                                '</div>';

                        content.push(element);
                    }
                }

                $("#elements").html(content);

                $("#sending-schema-div").hide();
                $("#continue-btn").hide();
                $("#elements-description-div").show();
            });

            // Data form
            $("#node-type-form").submit(function(e){
                e.preventDefault();

                var node_type_name = $("#type-name").val();

                var values = "";
                for(var i=0; i<schema.length; i++){
                    var value = $( "#" + i ).val();
                    if(typeof value !== 'undefined'){
                        values = values.concat(value + ";");
                    }
                }

                var data_schema = '<div class="alert alert-danger fade in alert-dismissable">' +
                        '<a class="close" data-dismiss="alert" aria-label="close" title="close" onclick="newDataSchema()">×</a>' +
                        '<br>' +
                        '<div class="row">' +
                        '<label class="col-md-4">Node Type Name</label>' +
                        '<div class="col-md-8">' +
                        '<input class="form-control" type="text" id="node-type-name" name="node-type-name" value="'+ node_type_name +'" readonly required>' +
                        '</div>' +
                        '</div>' +
                        ' <br>' +
                        '<div class="row">' +
                        '<label class="col-md-4">Node Type Data Schema</label>' +
                        '<div class="col-md-8">' +
                        '<input class="form-control" type="text" id="node-type-sensors" name="node-type-sensors" value="'+ values + '" readonly required>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                $("#data-schema").html(data_schema);
                $("#select-node-type").hide();

                // Close modal
                $('#schemaModal').modal('toggle');
            });

            $("#try-other-schema").click(function(){
                $("#schemaModal").modal();
                $("#sending-schema-div").show();
                $("#continue-btn").show();
                $("#elements-description-div").hide();
            });
        });

        function newDataSchema(){
            $("#select-node-type").show();
        }
    </script>
@endsection
