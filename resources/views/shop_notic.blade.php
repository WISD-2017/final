@extends('layouts.shopadmin')

@section('content')

<h1>通知總覽</h1>
<div class='row placeholders' id='content'>
       <div class='col-6 mt-3'>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">訂單</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                    <a href="#" class="card-link"> link</a>
                </div>
            </div>
       </div>
</div>
<script>
     $(document).ready(function(){
        var member=Cookies.get('shop')
        var url='/rest/api/shop/notic/'+member
        $.ajax({
            url: url,
            dataType: "json",
            type: 'post',
            data: { id: member},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if(data.success==1){
                    console.log(data)
                    
                }   
                
                
            }
        });
    });
    
</script>
@endsection