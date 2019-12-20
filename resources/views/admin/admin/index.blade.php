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
        <h2>管理员列表页面</h2>
        <form action="">
            <input type="text" name="admin_name" placeholder="请输入管理员名称" value="{{$query['admin_name']??''}}">
            <button>搜索</button>
        </form>
            <table border="1">
                <tr>
                    <td>管理员id</td>
                    <td>管理员名称</td>
                    <td>管理员密码</td>
                    <td>操作</td>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td>{{$v->admin_id}}</td>
                    <td>{{$v->admin_name}}</td>
                    <td>{{$v->admin_pwd}}</td>
                    <td>
                        <a href="{{url('/admin/edit/'.$v->admin_id)}}">编辑</a>
                        <a href="{{url('/admin/delete/'.$v->admin_id)}}">删除</a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{$data->appends($query)->links()}}
</body>
</html>