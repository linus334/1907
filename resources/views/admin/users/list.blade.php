<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>展示</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>id</td>
            <td>名称</td>
            <td>用户身份</td>
            <td>操作</td>
        </tr>
        @foreach($res as $v)
        <tr>
            <td>{{$v->user_id}}</td>
            <td>{{$v->user_name}}</td>
            <td>{{$v->status==1?'库管主管':'库管员'}}</td>
            <td>
                <a href="{{url('/deletes',$v->user_id)}}">禁用</a>
                <a href="{{url('/deletes',$v->user_id)}}">升主管</a>
            </td>
        </tr>
         @endforeach
    </table>
</body>
</html>