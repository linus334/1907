<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登陆</title>
</head>
<body>
<form action="{{url('/create')}}" method="post">
    @csrf
    用户名称: <input type="text" name="admin_name"><br>
    用户密码: <input type="password" name="admin_pwd"><br>
            <button>提交</button>
</form>
</body>
</html>