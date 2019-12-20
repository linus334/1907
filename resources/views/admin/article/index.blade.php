<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>展示</title>
    <script src="/static/admin/js/jquery.js"></script>
</head>
<body>
<form action="">
    文章分类: <select name="type_id" id="">
                <option value="">--请选择--</option>
                @foreach($typeInfo as $v)
                    @if(isset($query['type_id'])&&$v->type_id==$query['type_id'])
                    <option value="{{$v->type_id}}" selected="">{{$v->type_name}}</option>
                    @else
                     <option value="{{$v->type_id}}">{{$v->type_name}}</option>
                    @endif
                @endforeach
              </select><br>
    文章标题: <input type="text" name="title" value="{{$query['title']??''}}">
            <button>搜索</button>
    <h2><a href="{{url('article/create')}}">添加</a></h2>
</form>
    <table border="1">
        <tr>
            <td>id</td>
            <td>文章标题</td>
            <td>文章分类</td>
            <td>文章重要性</td>
            <td>是否展示</td>
            <td>文章作者</td>
            <td>作者email</td>
            <td>关键字</td>
            <td>文章描述</td>
            <td>文件上传</td>
            <td>操作</td>
        </tr>
        @foreach($articleInfo as $v)
        <tr id="{{$v->id}}">
            <td>{{$v->id}}</td>
            <td>{{$v->title}}</td>
            <td>{{$v->type_name}}</td>
            <td>{{$v->important==1 ? '普通' : '置顶'}}</td>
            <td>{{$v->display==1 ? '显示' : '不显示'}}</td>
            <td>{{$v->author}}</td>
            <td>{{$v->email}}</td>
            <td>{{$v->keyword}}</td>
            <td>{{$v->desc}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->upload}}" width="70"></td>
            <td>
                <a href="javascript:;" class="del">删除</a>
                <a href="{{url('/article/edit/'.$v->id)}}">编辑</a>
            </td>
        </tr>
        @endforeach
    </table>
{{$articleInfo->appends($query)->links()}}
</body>
</html>
<script>
    $(".del").click(function(){
        var id = $(this).parents('tr').attr('id');
       var r = confirm('确定要删除么');
        if(r==true) {
            $.ajax({
                url: "{{ URL('article/delete')}}",
                type: "POST",
                data:{id:id,_token:'{{csrf_token()}}'},
                success: function(data){
                    if(data==1){
                        alert('删除成功');
                        location.href= "{{ URL('article/index/')}}";
                    } else {
                        alert('删除失败');
                    }
                }});
        }
    })
</script>