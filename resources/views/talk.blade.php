@extends('layouts.admin')

@section('content')

    <h1>聊天室</h1>
    <div class="row ">
        <div class="col-2 ">123</div>
        <div class="col-10">
            <div class="row" id="main"  style="height: calc(100%px );">
                <div class="col-md-6" id="chat1" scrolling="yes" style="background-color:darkgray; height: 600px"></div>
                <div class="col-md-6 "  style="background-color:darkgray; ">123</div>
            </div>
            <div id="sendBox" class="input-group" style="background-color:darkgray">
                <input type="text" class="form-control" style="background-color:gainsboro" id="chat" value="" PLACEHOLDER="輸入訊息.." >
                <span class="input-group-btn">
                    <a class="btn btn-secondary" role="button" onclick="send()">傳送</a>
                </span>
            </div>
        </div>
    </div>

    <script>
        function send(){
            var a=document.getElementById('chat');
            var cook=Cookies.get('member');
            console.log(a.value,cook)
            document.getElementById('chat1').innerHTML+="<p>"+a.value+"</p>"
            $.ajax({
                url:'/rest/api/chat',
                dataType: "json",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{email:cook,chat1:a.value},
                success:function(data) {

                }
            });
        }

        /*function send(){
            var chat = document.getElementById("chat").value;
            $.ajax({
                url:'/rest/api/shop/due'
            })

        });*/
    </script>
@endsection