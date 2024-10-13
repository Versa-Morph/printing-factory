@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />

    <style>
        .text-heading {
            font-weight: 700;
            margin-bottom: 2% !important;
        }

        .btn.dropdown-toggle {
            border-radius: 16px !important;
            border-color: transparent !important;
        }

        .badge-ontime {
            color: rgba(160, 219, 93, 1) !important;
            background: rgba(160, 219, 93, 0.1) !important;
            padding: 16px;
            width: 91%;
            font-weight: 700;
        }

        .badge-late {
            color: rgba(219, 93, 93, 1);
            background: rgba(219, 93, 93, 0.1);
            padding: 16px;
            width: 91%;
            font-weight: 700;
        }

        .badge-no-data {
            color: black;
            background: #e6e6e686;
            padding: 16px;
            width: 91%;
            font-weight: 700;
        }
        #map {
            width: 90%;
            height: 500px;
            margin-left: 4em;
        }
    </style>
@endsection

@section('header-info-content')
 
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row align-items-start">
                <div class="col-sm">
                    <center>
                        <label>Attendance : {{ $attendanceEmploye->employee->first_name }}</label>
                    </center>
                    <br>
                </div>
            </div>

            <div id="map"></div>

        </div><!-- end card-body -->
    </div><!-- end card -->
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    {{-- CHART HEADER  --}}
    <!-- Chart code -->
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-clustering.js"></script>
    <script>
        // Initialize communication with the platform
        const platform = new H.service.Platform({
            apikey: 'KwQhdCbDfx_FIrmwo2gQELADMFwAimvH2sPf9aP8pTs'
        });
    
        var defaultLayers = platform.createDefaultLayers();
    
        var map = new H.Map(document.getElementById('map'), 
            defaultLayers.vector.normal.map, {
                zoom: 14,
                center: { lat: {{ $attendance[0]->latitude }}, lng: {{ $attendance[0]->longitude }} } // Default to first attendance
            }
        );
    
        window.addEventListener('resize', () => map.getViewPort().resize());
    
        var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
        var ui = H.ui.UI.createDefault(map, defaultLayers);
        var group = new H.map.Group();
        map.addObject(group);
    
        group.addEventListener('tap', function (evt) {
            var bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
                content: evt.target.getData()
            });
            ui.addBubble(bubble);
        }, false);
    
        @foreach ($attendance as $att)
            var marker = new H.map.Marker({ lat: {{ $att->latitude }}, lng: {{ $att->longitude }} });
            marker.setData(`<div>
                <img src="{{ asset('assets/img/attendance/'.$att->photo) }}" width="100" />
                <label><b>Type: {{ strtoupper($att->type) }}</b></label>
                @php
                    if ($att->type == 'clock-in') {
                        $jam_attend = $attendanceEmploye->clock_in;
                    }elseif ($att->type == 'clock-out') {
                        $jam_attend = $attendanceEmploye->clock_out;
                    }elseif ($att->type == 'break') {
                        $jam_attend = $attendanceEmploye->break_start;
                    }elseif ($att->type == 'after-break') {
                        $jam_attend = $attendanceEmploye->break_end;
                    }elseif ($att->type == 'overtime-in') {
                        $jam_attend = $attendanceEmploye->overtime_in;
                    }elseif ($att->type == 'overtime-out') {
                        $jam_attend = $attendanceEmploye->overtime_out;
                    }
                @endphp
                <label>Time: {{ \Carbon\Carbon::parse($jam_attend)->format('H:i:s') }}</label>
                <label>Reason: {{ $att->reason ?? 'N/A' }}</label>
                <label><a href="https://www.google.com/maps?q={{ $att->latitude }},{{ $att->longitude }}" target="_blank">
                    Go to Google Maps
                </a></label>
            </div>`);
            group.addObject(marker);
        @endforeach

    
    </script>
    
@endsection
