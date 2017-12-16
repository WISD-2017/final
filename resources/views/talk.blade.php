@extends('layouts.admin')

@section('content')

    <h1>聊天室</h1>
    <div class="row " style="overflow-y: hidden;">
        <div class="col-2 ">123</div>
        <div class="col-10">
            <div class="row" id="chat_div" style="height: 750px;overflow-y: scroll;">
                <div class="col-md-6" id="chatyou"></div>
                <div class="col-md-6 " id="chatme" ></div>
            </div>

            <!--div-- id="sendBox" style="position:fixed; bottom: 0px;">
                <input type="text" id="chat" value="" PLACEHOLDER="輸入訊息.." >
                <a class="btn btn-secondary" role="button" onclick="send()">傳送</a>
            </div-->
            <div class="col-12">
            <form id="sendBox" >
                <div class="form-row">
                    <div class="col-10">
                        <input type="text" id="chat" class="form-control" placeholder="輸入訊息">
                    </div>
                    <div class="col-2">
                        <a class="btn btn-success text-light" role="button" onclick="send()">傳送</a>
                    </div>
                </div>
            </form></div>
        </div>
    </div>

    <script>


        var x = document.getElementsByTagName("BODY")[0];
        x.style.hidden = "hidden";
        function send(){
            var a=document.getElementById('chat');
            var cook=Cookies.get('member');
            console.log(a.value,cook)

            document.getElementById('chatme').innerHTML+="<p>"+a.value+"</p>"
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