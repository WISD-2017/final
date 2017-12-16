@extends('layouts.manager')

@section('content')
<script>
$(document).ready(function(){
    $.ajax({
        url: '/rest/api/manger/setting',
        dataType: "json",
        type: 'get',
        success:function(data){
            console.log(data)
        }
                        
    });
});


</script>
@endsection