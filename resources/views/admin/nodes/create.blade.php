@extends('layout.admin')

@section('title')
    @lang('Create Node')
@endsection

@section('admin-content')
    <p class="title">
    </p><h2 style="margin-bottom: 0;">@lang('Create Node')</h2>
        <small class="text-primary">@lang('Dashboard') > @lang('Nodes') > @lang('Create')</small>
    </p>

    <hr>

    <form method="POST" action="{{ route('nodes.store') }}" id="create-form">
        {{csrf_field()}}

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="icon-addon addon-lg">
                    <input type="text" placeholder="@lang('Name')" class="form-control" id="name" name="name" value="{{ session('error') ? session('name') : old('name') }}" required autofocus>
                    <label for="name" class="fa fa-bookmark" rel="tooltip" title="name"></label>
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
            <div class="icon-addon addon-lg">
                <input type="text" placeholder="@lang('Location')" class="form-control" id="location" name="location" value="{{ session('error') ? session('location') : old('location') }}" required>
                <label for="location" class="fa fa-map-marker" rel="tooltip" title="location"></label>
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
                    <input type="text" placeholder="@lang('Latitude')" class="form-control" id="latitude" name="latitude" value="{{ session('error') ? session('latitude') : old('latitude') }}" required>
                    <label for="latitude" class="fa fa-globe" rel="tooltip" title="latitude"></label>
                </div>
                @if ($errors->has('latitude'))
                    <span class="help-block">
                    <strong>{{ $errors->first('latitude') }}</strong>
                </span>
                @endif
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                <div class="icon-addon addon-lg">
                    <input type="text" placeholder="@lang('Longitude')" class="form-control" id="longitude" name="longitude" value="{{ session('error') ? session('longitude') : old('longitude') }}" required>
                    <label for="longitude" class="fa fa-globe" rel="tooltip" title="longitude"></label>
                </div>
                @if ($errors->has('longitude'))
                    <span class="help-block">
                        <strong> {{ $errors->first('longitude') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div id="createMap"></div>

        <p class="pull-right">
            <i class="fa fa-info-circle text-primary"></i> &nbsp; @lang('Add a marker to the map and get its latitude and longitude')
        </p>

        <br><br>

        <h3>@lang('Choose Node Type')</h3>
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
                    <div class="radio-inline radio-primary">
                        <input type="radio" name="node-type" id="{{ $nodeType->id }}" value="{{ $nodeType->id }}" @if ($loop->first) checked @endif>

                        <label for="{{ $nodeType->id }}" class="radio-inline">
                            {{ $nodeType->name }}
                            <br>
                            <small><strong class="text-primary">@lang('Data Delimiter') </strong></small> {{ $nodeType->separator }}

                            <dl>
                                <dt><small class="text-primary">@lang('Parameters')</small></dt>

                                <dd>
                                    @foreach($nodeType->sensors as $sensor)
                                        <small>
                                            @if(array_key_exists('unit', $sensor) or array_key_exists('description', $sensor))
                                                <strong>{{ $sensor["variable"]}}</strong>
                                            @else
                                                {{ $sensor["variable"]}}
                                            @endif


                                            @if(array_key_exists('unit', $sensor))
                                                ({{ $sensor["unit"] }})
                                            @endif
                                            @if(array_key_exists('description', $sensor))
                                                : {{ $sensor["description"] }}
                                            @endif

                                            @if(!$loop->last)
                                                ,
                                            @endif

                                            @if(array_key_exists('unit', $sensor) or array_key_exists('description', $sensor))
                                                <br>
                                            @endif
                                        </small>
                                    @endforeach
                                </dd>

                            </dl>
                        </label>
                    </div>
                </div>
            @endforeach
            <div class="col-sm-6">
                <div class="radio-primary">
                    <input type="radio" name="node-type" id="node-type" data-toggle="modal" data-target="#schemaModal" value="sending-schema">
                    <label for="node-type" class="radio-inline">
                        @lang('Choose Data Sending Schema')
                    </label>
                </div>
            </div>
        </div>

        <br>
        <div class="row">
            <input type="submit" class="btn btn-primary btn-lg pull-right" value="@lang('Save')">
        </div>
    </form>

@endsection

@section('modal')
    <div id="schemaModal" class="modal fade" role="dialog" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title tex"><strong>@lang('Set Node Data Sending Schema')</strong></h3>
                </div>
                <div class="modal-body" style="padding: 30px">
                    <form id="node-type-form">
                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-4" for="type-name">@lang('Node Type Name')</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="type-name" name="type-name" type="text" placeholder="e.g. @lang('Water Quality')" required>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-4" for="type-name">@lang('Split Data By')</label>
                                <div class="col-md-8">
                                    <div style="padding:16px;">
                                        <div class="row">
                                            <label class="radio-inline">
                                                <input type="radio" name="delimiter" value=" " checked> @lang('Whitespace') ( )
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="delimiter" value=";"> @lang('Semicolon') ( ; )
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="delimiter" value="-"> @lang('Hyphen') ( - )
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="delimiter" value="/"> @lang('Slash') ( / )
                                            </label>
                                        </div>
                                        <br>
                                        <div class="row form-group">
                                            <label class="radio-inline col-md-2">
                                                <input type="radio" name="delimiter" value="other-delimiter"> @lang('Other')
                                            </label>
                                            <div class="col-md-4">
                                                <input class="form-control" id="other" type="text" maxlength="3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group" id="sending-schema-div">
                                <label class="control-label col-md-4" for="sending-schema">@lang('Node Data Sending Schema') </label>
                                <div class="col-md-8">
                                    <textarea class="form-control" rows="3" id="sending-schema" placeholder="e.g. 25.3;25.3;25.3;85;22.6;1.3;ESE;0.08;1.3;ESE;25.3;27.6;27.4"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="continue-btn-div">
                            <br>
                            <button type="button" class="btn btn-primary pull-right" id="continue-btn" disabled>@lang('Continue')</button>
                        </div>

                        <div id="elements-description-div" style="display: none">
                            <h4><strong>@lang('Parameters Type Selectors')</strong></h4>
                            <div class="row" id="elements"></div>
                            <br><br>
                            <div class="row">
                                <a class="btn btn-danger" id="try-other-schema">@lang('Try Other Data Sending Schema') </a>
                                <button type="submit" class="btn btn-primary pull-right">@lang('Save')</button>
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
            var map = L.map('createMap').setView([10.420737,-75.54755], 15);

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 20,
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
                var latitude = e.latlng.lat.toFixed(6);
                var longitude = e.latlng.lng.toFixed(6);

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
            // Enable other separator
            $('#other').hide();
            $("[name=delimiter]").change(function(){
                if(this.value == 'other-delimiter') {
                    $('#other').show();
                } else {
                    $('#other').hide();
                }
            });

            // Enable Continue button according to sending-schema text area
            $('#continue-btn').attr('disabled',true);
            $('#sending-schema').keyup(function(){
                if($(this).val().length != 0) {
                    $("#continue-btn").attr('disabled', false);
                } else{
                    $("#continue-btn").attr('disabled',true);
                }
            });

            // Process data schema
            var schema;
            $("#continue-btn").click(function() {

                // Get delimiter
                var delimiter = getSchemaDelimiter();

                var schema_str = $("#sending-schema").val();

                schema = schema_str.split(delimiter);

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
                $("#continue-btn-div").hide();
                $("#elements-description-div").show();
            });

            // Data form
            $("#node-type-form").submit(function(e){
                e.preventDefault();

                // Get delimiter
                var delimiter = getSchemaDelimiter();

                var node_type_name = $("#type-name").val();

                var values = "";
                for(var i=0; i<schema.length; i++){
                    var value = $( "#" + i ).val();
                    if(typeof value !== 'undefined'){
                        values = values.concat(value + delimiter);
                    }
                }

                var data_schema = '<div class="alert alert-danger fade in alert-dismissable">' +
                        '<a class="close" data-dismiss="alert" aria-label="close" title="close" onclick="newDataSchema()">×</a>' +
                        '<br>' +
                        '<div class="row">' +
                        '<label class="col-md-2">@lang("Node Type Name")</label>' +
                        '<div class="col-md-6">' +
                        '<input class="form-control" type="text" name="node-type-name" value="'+ node_type_name +'" readonly required>' +
                        '</div>' +
                        '<label class="col-md-2">@lang("Split Data By")</label>' +
                        '<div class="col-md-2">' +
                        '<input class="form-control" type="text" name="node-type-delimiter" value="'+ delimiter +'" readonly required>' +
                        '</div>' +
                        '</div>' +
                        ' <br>' +
                        '<div class="row">' +
                        '<label class="col-md-2">@lang("Data Schema")</label>' +
                        '<div class="col-md-10">' +
                        '<input class="form-control" type="text" name="node-type-sensors" value="'+ values + '" readonly required>' +
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
                $("#continue-btn-div").show();
                $("#elements-description-div").hide();
            });
        });

        function newDataSchema(){
            $("#select-node-type").show();
        }

        function getSchemaDelimiter(){
            var delimiter;

            if($('input[name=delimiter]:checked').val() == 'other-delimiter'){
                delimiter = $("#other").val();
            }else{
                delimiter = $('input[name=delimiter]:checked').val();
            }

            return delimiter;
        }
    </script>
@endsection
