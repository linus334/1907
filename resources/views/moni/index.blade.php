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
            <td>班级</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->s_id}}</td>
            <td>{{$v->s_name}}</td>
            <td>{{$v->c_name}}</td>
            <td><a href="">删除</a></td>
        </tr>
        @endforeach
    </table>
{{$data->links()}}
</body>
</html>