@extends('layouts.shopadmin')

@section('content')
<h1>營收總覽</h1>
<section class="row text-center placeholders">
    <div class="col-6 col-sm-6 placeholder">
        <canvas id="myChart" width="700" height="400"></canvas>
        <h4>各月營收</h4>
    </div>
    <div class="col-6 col-sm-6 placeholder">
        <canvas id="myChart2" width="700" height="400"></canvas>
        <h4>銷售情況</h4>
        
    </div>
</section>
<div class='col-12'>
    <div class='row'>
        <h2 class='mr-5'>營收明細</h2>
        <form class="form-inline">
            <div class="form-group">
                <label class="col-sm-12 col-form-label">搜尋id:</label>
            </div>
            <div class="form-group mx-sm-12">
                <input type="text" class="form-control" id="table_id" placeholder="搜尋id" >
                <a  class="btn btn-primary text-light" onclick='search_id()'>確定</a>
            </div>
        </form>
     
    </div>
<div class="table-responsive mt-3">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>id</th>
                  <th>訂單編號</th>
                   <th>總價</th>
                  <th>完成時間</th>
                  <th>詳細</th>
                </tr>
              </thead>
              <tbody id='tbody'>
                <tr>
                  <td>1</td>
                  <td>torquent</td>
                  <td>per</td>
                  <td>conubia</td>
                  <td>nostra</td>
                </tr>
                
              </tbody>
            </table>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js"></script>
<script>
$(document).ready(function(){ 
    console.log(cook)
    get_dashboard();
    var url='/rest/api/buy/revenue_details/'+cook
    $.ajax({
        url: url,
        dataType: "json",
        type: 'get',
        success: function (data) {
            if(data.success==1){
                var data=data.data
                var html="";
                for(var i=0;i<data.length;i++){
                    var j=i+1
                    html+="<tr><td>"+j+"</td><td>"+data[i].id+"</td><td>"+data[i].money+"</td><td>"+data[i].time+"</td><td><a>詳細</a></td></tr>"
                }
                document.getElementById('tbody').innerHTML=html
            }

        }
    });
});
function search_id(){
    var text=document.getElementById('table_id').value
    if(text!=""){
        console.log(text)
    }     
}
function get_dashboard(){
    var url='/rest/api/buy/revenue_dashboard/'+cook
    $.ajax({
        url:url,
        dataType:"json",
        type:'get',
        success:function(data){
            console.log(data)
        }
    });
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["1月", "2月", "3月", "4月", "5月", "6月","7月", "8月", "9月", "10月", "11月", "12月"],
            datasets: [{
                label: '# of Votes',
                data: [40, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
}

var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }

});
</script>
@endsection