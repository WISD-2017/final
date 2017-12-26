@extends('layouts.admin')

@section('content')

    <h1>聊天室</h1>
    <div class="row " style="overflow-y: hidden;">
        <div class="col-2 " id="shoplist"style="background-color:papayawhip">
            {{--<div id="list-example" class="list-group" >--}}
                {{--<a class="list-group-item list-group-item-action" href="#list-item-1">Item 1</a>--}}
            {{--</div>--}}
        </div>

        <div class="col-10">
            <div class="row" id="chat_div" style="height: 750px;overflow-y: scroll;">
                <div class="col-md-6" id="chatyou"></div>
                <div class="col-md-6 " id="chatme">
                    <div class="tooltip bs-tooltip-left bs-tooltip-left-docs mt-1" role="tooltip" style='opacity: 0;right:10px;'>
                        <div class="arrow mt-3"></div>
                        <div class="tooltip-inner"></div>
                    </div>
                    <br>
                </div>
            </div>


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
        $(document).ready(function(){
            get_shop();
        });
        var x = document.getElementsByTagName("BODY")[0];
        x.style.hidden = "hidden";
        function send(){
            var shopid=Cookies.get('connect');
            var a=document.getElementById('chat');
            var member=Cookies.get('member');
            var html="<br><div class='tooltip bs-tooltip-left bs-tooltip-left-docs mt-1' role='tooltip' style='opacity: 1;right:10px;'><div class='arrow mt-3'></div><div class='tooltip-inner'>"+a.value+"</div></div><br>"

            document.getElementById('chatme').innerHTML+=html;
            $.ajax({
                url:'/rest/api/chat',
                dataType: "json",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{id:member,chatText:a.value,shop_id:shopid},
                success:function(data) {
                    if(data.success==1){

                    }
                }
            });
        }
        function get_shop(){
            var member=Cookies.get('connect');
            $.ajax({
                url:'/rest/api/getshop',
                dataType: "json",
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{id:member},
                success:function(data) {
                    if(data.success==1){
                        var data=data.data;
                        console.log(data);
                        var html="<div id='list-example'class='list-group text-center'><a class='list-group-item list-group-item-action' id='shop"+data+"' style='background-color:#f8f9fa;position:absolute;left:0px;width:100%' onclick='get_talk()' href='#list-item-1'>"+data+"</a></div>"
                        document.getElementById('shoplist').innerHTML+=html;
                        var shopname = document.getElementById("shop"+data);
                        console.log(shopname);
                        if(shopname.content==1){
                            shopname.innerHTML+="<div id='list-example'class='list-group text-center'><a class='list-group-item list-group-item-action' id='shop"+data+"' style='background-color: #007bff;color:#fff;position:absolute;left:0px;width:100%' onclick='get_talk()' href='#list-item-1'>"+data+"</a></div>"
                        }
                    }
                }
            }) ;
        }
        function get_talk(){
            //var
        }

    </script>
@endsection