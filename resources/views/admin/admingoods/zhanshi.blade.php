<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="1">
    <tr>
        <td>id</td>
        <td>名称</td>
        <td>货物图</td>
        <td>库存</td>
        <td>添加时间</td>
        <td>操作</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->g_id}}</td>
        <td>{{$v->g_name}}</td>
        <td><img src="{{env('UPLOAD_URL')}}{{$v->g_logo}}" width="100"></td>
        <td>{{$v->g_num}}</td>
        <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
        <td>
            <a href="{{url('/uplodes',$v->g_id)}}">出库</a>
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>