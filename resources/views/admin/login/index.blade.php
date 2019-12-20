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
{{session('msg')}}
<form action="{{url('/login/loginDo')}}" method="post">
    @csrf
    用户名称: <input type="text" name="name"><br>
    用户密码: <input type="password" name="password"><br>
             <input type="submit" value="提交">
</form>
</body>
</html>