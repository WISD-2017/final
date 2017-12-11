@extends('layouts.shopadmin')

@section('content')

<h1>{{"訂單編號：$id"}}</h1>
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
        <div class='row'>
            <div class='col-8'>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">訂單內容</h4>
                        <div class='row' id='check_content'>
                            <div class='col-4 mt-3 text-center'>商品</div>
                            <div class='col-4 mt-3 text-center'>數量</div>
                            <div class='col-4 mt-3 text-center'>價錢</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-4'>
            
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">顧客訊息</h4>
                            <p>地址：<small id="addr"></smaill></p>
                            <p>Emial：<small id="email"></smaill></p>
                            <div class='text-right'>
                                <a href="/store/admin/talk" class="card-link">聯絡顧客</a>
                            </div>
                    </div>
                </div>
                <a class="btn btn-success btn-lg btn-block mt-4" href="/store/admin/googleMap" role="button">Google MAP</a>
                
                <a class="btn btn-warning btn-lg btn-block" role="button" onclick="check_detail(this.id)" id='check_detail'>訂單製作中</a> 
                
            </div>
        </div>
    
    </div>
    


       
</div>
<script>
    
    $(document).ready(function(){
        var id="{{$id}}"
        var user=Cookies.get('check_u')
        console.log(id)
        $.ajax({
            url: '/rest/api/buy/shop_detial',
            dataType: "json",
            type: 'get',
            data: {orderlist:id,user_id:user},
            success: function (data) {
                if(data.success==1){
                    var d=data.data
                    var element=document.getElementsByClassName('check')
                    var progress=document.getElementById('progress')
                    if(d[0].one==1){
                        progress.style.width='25%';
                        progress.innerHTML='25%'
                        element[0].className+=' text-success';
                        document.getElementById('one').innerHTML=d[0].time1
                    }
                    if(d[0].two==1){
                        progress.style.width='50%'
                        progress.innerHTML='50%'
                        element[1].className+=' text-success';
                        document.getElementById('two').innerHTML=d[0].time2
                    }
                    if(d[0].three==1){
                        progress.style.width='75%';
                        progress.innerHTML='75%'
                        element[2].className+=' text-success';
                        document.getElementById('three').innerHTML=d[0].time3
                    }
                    if(d[0].four==1){
                        progress.style.width='100%';
                        progress.innerHTML='100%'
                        element[3].className+=' text-success';
                        document.getElementById('four').innerHTML=d[0].time4
                        document.getElementById('done').className+=' disabled'
                    }
                    var d=data.food
                    var html=""
                    var money=0
                    for(var i=0;i<d.length;i++){
                        // <div class='col-4 mt-3'>123</div>
                        html+="<div class='col-4 mt-3 text-center'>"+d[i].food+"</div>"
                        html+="<div class='col-4 mt-3 text-center'>"+d[i].amount+"</div>"
                        html+="<div class='col-4 mt-3 text-center'>"+d[i].money+"</div>"
                        money+=d[i].money
                    }
                    var d=data.order
                    switch(d[0].service){
                        case "0":
                            service="內用"
                            break;
                        case "1":
                            service="外送"
                            break;
                        case "2":
                            service="外帶"
                            break;
                    }
                    html+="<div class='col-3 mt-4 text-center'>預約服務:</div><div class='col-3 mt-4 text-center'>"+service+"</div><div class='col-3 mt-4 text-center'>預約時間:</div><div class='col-3 mt-4 text-center'>"+d[0].time+"</div>"
                    html+="<div class='col-8 mt-4 text-center' style='font-size:2rem;'>總價:</div><div class='col-4 mt-4 text-center text-info' style='font-size:2rem;'>"+money+"</div"
                    document.getElementById('check_content').innerHTML+=html;
                    var d=data.user
                    console.log(d)
                    document.getElementById('email').innerHTML=d[0].email;
                    document.getElementById('addr').innerHTML=d[0].addr;
                }
            }
        });
    });
    function check_detail(id){
        var element=document.getElementById(id)
        
        var user=Cookies.get('check_u')
        console.log(element.innerHTML)
        
        if(element.innerHTML=="訂單製作中"){
            var id=1
            $.ajax({
                url: '/rest/api/buy/shop_check/'+id+"/"+user,
                type: 'PATCH',
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){

                }
            });
            element.innerHTML="訂單運送中"
        }
        if(element.innerHTML=="訂單運送中"){
            var id=2
        }

    }
</script>
@endsection