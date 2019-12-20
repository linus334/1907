<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
</head>
<body>
<h2>品牌添加</h2>
{{-- 第一种验证提示文字
@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
        {{--<ul>--}}
            {{--@foreach ($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
{{--@endif--}}

<form class="form-horizontal" role="form" action="{{url('/brand/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="brand_name" placeholder="请输入品牌名称" name="brand_name">
            <b style="color: red">@php echo $errors->first('brand_name');  @endphp</b>{{--！第三种（手动验证）提示--}}
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="brand_url" placeholder="请输入品牌网址" name="brand_url">
            <b style="color: red">@php echo $errors->first('brand_url');  @endphp</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="lastname" placeholder="请输入品牌LOGO" name="brand_logo">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" placeholder="请输入品牌描述" name="brand_desc"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="button" class="btn btn-default" value="提交">
        </div>
    </div>
</form>
</body>
</html>
<script>
//    $.ajaxSetup({
//        headers: {
//            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//        }
//    });
    //品牌名失去焦点
    $("#brand_name").blur(function(){
        var brand_name = $(this).val();
        var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
        if(!reg.test(brand_name)){
            $(this).parent().addClass('has-error');
            $(this).next().text('品牌名称不符合规定');
            return;
        }
    //品牌名验证唯一性
        $.ajax({
            method:"post",
            url:"{{url('/brand/checkOnly')}}",
            data:{brand_name:brand_name}
        }).done(function(msg){
            if( msg>0){
                $("#brand_name").parent().addClass('has-error');
                $("#brand_name").next().text('品牌名称已存在');
            }
        })
    })

    //品牌名称失去焦点
    $("#brand_url").blur(function(){
        var brand_url = $(this).val();
        var reg = /^(http:\/\/)([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/
        if(!reg.test(brand_url)){
            $("#brand_url").parent().addClass('has-error');
            $("#brand_url").next().text('品牌网址不符合规定');
            return;
        }
    })

    //表单提交事件
    $(".btn-default").click(function(){
        var brand_name = $("#brand_name").val();
        var reg = /^[\u4e00-\u9fa5\w]{2,20}$/;
        if(!reg.test(brand_name)){
            $("#brand_name").parent().addClass('has-error');
            $("#brand_name").next().text('品牌名称不符合规定');
            return;
        }
        var flag = true;
        //品牌名验证唯一性
        $.ajax({
            method:"post",
            url:"{{url('/brand/checkOnly')}}",
            async:false,
            data:{brand_name:brand_name}
        }).done(function(msg){
            if( msg>0){
                $("#brand_name").parent().addClass('has-error');
                $("#brand_name").next().text('品牌名称已存在');
                flag = false;
            }
        })
        if(!flag){
            return;
        }

        var brand_url = $("#brand_url").val();
        var reg = /^(http:\/\/)([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/
        if(!reg.test(brand_url)){
            $("#brand_url").parent().addClass('has-error');
            $("#brand_url").next().text('品牌网址不符合规定');
            return;
        }
        $('form').submit();
    })
</script>