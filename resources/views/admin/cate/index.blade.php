<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分类列表</title>
</head>
<body>
    <table border="1">
        <tr>
            <td>分类id</td>
            <td>分类名称</td>
            <td>是否展示</td>
            <td>是否在导航栏展示</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->cate_id}}</td>
            <td>{{$v->cate_name}}</td>
            <td>{{$v->cate_show==1?'√':'×'}}</td>
            <td>{{$v->cate_nav_show==1?'√':'×'}}</td>
            <td>
                <a href="{{url('/cate/edit/'.$v->cate_id)}}">编辑</a>
                <a href="{{url('/cate/delete/'.$v->cate_id)}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
        {{$data->links()}}
</body>
</html>