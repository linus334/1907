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
<h2>管理员添加</h2>
    <form action="{{url('/admin/store')}}" method="post">
                    @csrf
        管理员名称: <input type="text" name="admin_name"><br>
                    <b style="color: red">@php echo $errors->first('admin_name'); @endphp</b><br>
        管理员密码: <input type="password" name="admin_pwd"><br>
                    <b style="color: red">@php echo $errors->first('admin_pwd'); @endphp</b><br>
                    <button>添加</button>
    </form>
</body>
</html>