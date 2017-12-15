
@extends('layouts.admin')

@section('content')
<div class='row'>
    <div class='col-12'>
        <div class="jumbotron jumbotron-fluid bg-muted">
            <div class="container">
                <div class="progress" style="height:30px;">
                    <div id='progress' class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>
                <div class='row mt-4'>
                    <div class='col text-center'>
                        <p class="lead text-success check">訂單建立</p>
                        <small id='one'></small>
                    </div>
                    <div class='col text-center'>
                        <p class="lead check">訂單製作</p>
                        <small id='two'></small>
                    </div>
                    <div class='col text-center'>
                        <p class="lead check">訂單運送</p>
                        <small id='three'></small>
                    </div>
                    <div class='col text-center'>
                        <p class="lead check">訂單完成</p>
                        <small id='four'></small>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class='col-12'>
        <div id='map'></div>

    </div>
</div>
    <script>
    
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay;
        var  map = new google.maps.Map(document.getElementById('map'), {
            zoom: 9,
            center: {lat: 25.0262205 , lng: 121.5236503}
       });
       directionsDisplay = new google.maps.DirectionsRenderer({
                'map': map,
                'preserveViewport': true,
                'draggable': true
        });
        
        var start="台北市中正區北平西路3號";
        var end="台北市文山區新光路二段30號"
        var request = {
            origin: start,
                destination: end,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
                //規畫路徑回傳結果
                console.log(response)
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    }
                });
     
    }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvzZj_o6PJSFi0GStAwPeDTBGjl4qIBM4&callback=initMap">
    </script>
    @endsection
