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
<form action="{{url('/creates')}}" method="post" enctype="multipart/form-data">
    @csrf
    货物名称: <input type="text" name="g_name"><br>
    货物图: <input type="file" name="g_logo"> <br>
    货物库存: <input type="text" name="g_num"> <br>
            <button>提交</button>
</form>
</body>
</html>