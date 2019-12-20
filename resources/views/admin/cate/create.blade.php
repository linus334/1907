<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>分类添加</title>
</head>
<body>
    <h2>分类添加</h2>

    <form action="{{url('/cate/store')}}" method="post">
        @csrf
        <table border="1">
            <tr>
                <td>分类名称</td>
                <td><input type="text" name="cate_name"> </td>
            </tr>
            <tr>
                <td>是否展示</td>
                <td>
                    <input type="radio" name="cate_show" value="1">是
                    <input type="radio" name="cate_show" value="2">否
                </td>
            </tr>
            <tr>
                <td>是否在导航栏展示</td>
                <td>
                    <input type="radio" name="cate_nav_show" value="1">是
                    <input type="radio" name="cate_nav_show" value="2">是
                </td>
            </tr>
            <tr>
                <td>父类</td>
                <td>
                    <select name="parent_id" id="">
                        <option value="">--请选择--</option>
                        @foreach($info as $v)
                        <option value="{{$v->cate_id}}">{{str_repeat(' -',$v['level']*3)}}{{$v->cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr >
                <td><button>添加</button></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>