<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
</head>
<body>

<form action={{url('/reg/doReg')}} method="post">
    @csrf
    用户名称: <input type="text" name="name"><br>
    用户邮箱: <input type="email" name="email"><br>
    用户密码: <input type="password" name="password"><br>
    <input type="submit" value="提交">
</form>
</body>
</html>