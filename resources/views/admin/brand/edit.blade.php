<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <title></title>
</head>
<body>
<h2>品牌修改</h2>
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

<form class="form-horizontal" role="form" action="{{url('/brand/update/'.$data->brand_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" placeholder="请输入品牌名称" name="brand_name" value="{{$data->brand_name}}">
            <b style="color: red">@php echo $errors->first('brand_name');  @endphp</b>{{--！第三种（手动验证）提示--}}
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" placeholder="请输入品牌网址" name="brand_url" value="{{$data->brand_url}}">
            <b style="color: red">@php echo $errors->first('brand_url');  @endphp</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
        <div class="col-sm-10">
            <img src="{{env('UPLOAD_URL')}}{{$data->brand_logo}}" width="100">
            <input type="file" class="form-control" id="lastname" placeholder="请输入品牌LOGO" name="brand_logo">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" placeholder="请输入品牌描述" name="brand_desc">{{$data->brand_desc}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>
</form>
</body>
</html>