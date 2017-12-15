<!DOCTYPE html>
<html>
  <head>
   <meta charset="utf-8">
    <meta name="csrf-token" content={{csrf_token()}}>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
        crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" idropdownMenuButtonntegrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.4/js.cookie.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    
    <style>
       #map {
        height: 1000px;
        width: 100%;
       }
       #right-panel{
           height:100%;

       }
    </style>
  </head>
  <body>
  <div class="container-fluid">
        <div class="row">
            <div class='col-12'>AA</div>
            <div class='col-9'>
                <div id="map" ></div>
            </div>
            <div class='col-3' id='right-panel'>


            </div>
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
        directionsDisplay.setPanel(document.getElementById('right-panel'));
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
  </body>
</html>