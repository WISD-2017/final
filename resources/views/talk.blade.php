@extends('layouts.admin')

@section('content')

    <h1>聊天室</h1>
    <div class="row ">
        <div class="col-2 ">123</div>
        <div class="col-10">
            <div class="row">
                <div class="col-md-6" id="chat1" style="background-color:darkgray;height: 750px; "></div>
                <div class="col-md-6 "  style="background-color:darkgray; ">123</div>
            </div>
            <div class="input-group" style="background-color:darkgray">
                <input type="text" class="form-control" style="background-color:gainsboro" id="chat" value="" >
                <span class="input-group-btn">
                    <a class="btn btn-secondary" role="button" onclick="send()">傳送</a>
                </span>
            </div>
        </div>
    </div>

    <script>
        function send(){
            var a=document.getElementById('chat');

            console.log(a.value)
            document.getElementById('chat1').innerHTML+="<p>"+a.value+"</p>"

        }

        /*function send(){
            var chat = document.getElementById("chat").value;
            $.ajax({
                url:'/rest/api/shop/due'
            })

        });*/
    </script>
@endsection